<?php

namespace AbdelrhmanSaeed\Tpo\Controllers;

use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;


class TPOController
{
    private Request $request;
    private Response $response;
    private HttpClientInterface $client;

    private array $availableRooms = [];

    private array $prebook = [];
    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
        $this->client = HttpClient::createForBaseUri('http://api.tbotechnology.in/', [
            'auth_basic' => ['Africanqueen', 'Afr@15739396'],
        ]);
    }

    public function hotelSearchView(): void
    {
        require __DIR__ . '/../Views/hotelSearch.php';
    }

    public function hotelSearch()
    {
        $requestData = [
            "HotelCodes"            => "1025726,1256773,1369478",
            "CityCode"              => "",
            "GuestNationality"      => "EG",
            "PreferredCurrencyCode" => "EGP",
            "IsDetailResponse"      => true,
            "ResponseTime"          => 23,
            "Filters" => [
                "MealType"      => "All",
                "Refundable"    => "true",
                "NoOfRooms"     => $this->request->get('rooms_number'),
            ]
        ];

        $incomingData = $this->request->request->all();
        unset($incomingData['rooms_number']);

        $paxRooms = array_map(
            function (array $room) {
                $room['ChildrenAges'] = explode(',', $room['ChildrenAges']);
                return $room;
            },
            $incomingData['PaxRooms']
        );

        session_start();
        $_SESSION['PaxRooms'] = $incomingData['PaxRooms'] = $paxRooms;

        $requestData = array_merge($requestData, $incomingData);

        $response = $this->client->request('POST', 'TBOHolidays_HotelAPI/HotelSearch', [
            'json' => $requestData
        ]);

        $responseData = json_decode($response->getContent(), true);
        $hotels = [];

        if (! empty($responseData['HotelSearchResults'])) {
            $hotels = $responseData['HotelSearchResults'];
        }

        require __DIR__ . '/../Views/hotelSearch.php';
    }



    public function availableHotelRooms()
    {
        $query = $this->request->get('hotelId');

        $response = $this->client->request('POST', '/TBOHolidays_HotelAPI/AvailableHotelRooms', [
            'json' => ['HotelBookingCode' => $query]
        ]);

        // echo $response->getContent();
        $content = $response->toArray();

        if (isset($content['Rooms'])) {
            $this->availableRooms = $content['Rooms'];
        }

        $availableRooms = $this->availableRooms;
        require __DIR__ . '/../Views/rooms.php';
    }

    public function preBook()
    {
        $query = $this->request->get('BookingCode');

        $response = $this->client->request('POST', '/TBOHolidays_HotelAPI/Prebook', [
            'json' => ['BookingCode' => $query]
        ]);

        $content = $response->toArray();

        if (isset($content['HotelResult'])) {
            $this->prebook = $content['HotelResult'];
        }

        $prebook = $this->prebook;
        require __DIR__ . '/../Views/preBookView.php';
    }

    public function availableHotelRoomsView(): void
    {
        $availableRooms = $this->availableRooms;
        require __DIR__ . '/../Views/rooms.php';
    }

    public function preBookView()
    {
        require __DIR__ . '/../Views/preBookView.php';
    }

    public function hotelBookView()
    {
        // echo "<pre>";
        // session_start();
        // print_r($_SESSION['PaxRooms']);
        // exit;
        $bookingCode = $this->request->get('bookingCode');
        $totalFare   = $this->request->get('totalFare');

        require __DIR__ . '/../Views/hotelBook.php';
    }

    public function hotelBook()
    {
        $requestData = [
            "BookingType"           => "Voucher", // Confirm/Voucher
            "ClientReferenceId"     => $id = uniqid(),
            "BookingReferenceId"    => $id,
            "PaymentMode"           => "Limit",
            "GuestNationality"      => "EG",
            "EmailId"               => "trav" . rand(0, 1000) . "@abc.com",
            "PhoneNumber"           => 201237374747,
            'BookingCode'           => $this->request->get('bookingCode'),
            'TotalFare'             => $this->request->get('totalFare'),
            'CustomerDetails'       => $this->request->get('CustomerDetails'),
        ];

        $response = $this->client->request(
            'POST',
            '/TBOHolidays_HotelAPI/HotelBook',
            ['json' => $requestData]
        );

       

    $responseData = json_decode($response->getContent(), true);

    if ($responseData['Status']['Code'] == 200) {
        $newData = [
            "ClientReferenceId" => $responseData['ClientReferenceId'],
            "ConfirmationNumber" => $responseData['ConfirmationNumber']
        ];

        $filePath = __DIR__ . '/../assets/confirmation_numbers.json';

        // Read existing data from the file
        if (file_exists($filePath)) {
            $fileContent = file_get_contents($filePath);
            $existingData = json_decode($fileContent, true);
        } else {
            $existingData = [];
        }

        // Append new data
        $existingData[] = $newData;

        // Write updated data back to the file
        file_put_contents($filePath, json_encode($existingData, JSON_PRETTY_PRINT));
    }

    

    }


    public function confirmBookingView()
    {
        $conNums = json_decode(
            file_get_contents(__DIR__ . '/../assets/confirmation_numbers.json'),
            true
        );
        require __DIR__ . '/../Views/confirmBooking.php';
    }

    public function cancelConfirm()
    {
        $conNums = json_decode(
            file_get_contents(__DIR__ . '/../assets/confirmation_numbers.json'),
            true
        );

        $confirmNum = $this->request->get('confirmNum');

        $conNums = array_filter(
            $conNums,
            fn($conNum) => $conNum['ConfirmationNumber'] !== $confirmNum
        );

        file_put_contents(
            __DIR__ . '/../assets/confirmation_numbers.json',
            json_encode($conNums)
        );

        header('Location: /confirmBookingList');
    }
}
