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

    private array $availableRooms = [
        [
            "Name" => ["Double Or Twin Deluxe Executive", "Double Or Twin Deluxe Executive"],
            "BookingCode" => "1256773!TB!1!TB!5f909d1f-c658-4be1-8831-32488c688f5f",
            "Inclusion" => "ROOM ONLY",
            "TotalFare" => 96.17,
            "TotalTax" => 0,
            "RoomPromotion" => [],
            "CancelPolicies" => [
                [
                    "Index" => "1",
                    "FromDate" => "16-12-2025 00:00:00",
                    "ChargeType" => "Percentage",
                    "CancellationCharge" => 100.0
                ],
                [
                    "Index" => "1",
                    "FromDate" => "21-01-2025 00:00:00",
                    "ChargeType" => "Fixed",
                    "CancellationCharge" => 0.0
                ],
                [
                    "Index" => "2",
                    "FromDate" => "16-12-2025 00:00:00",
                    "ChargeType" => "Percentage",
                    "CancellationCharge" => 100.0
                ],
                [
                    "Index" => "2",
                    "FromDate" => "21-01-2025 00:00:00",
                    "ChargeType" => "Fixed",
                    "CancellationCharge" => 0.0
                ]
            ],
            "MealType" => "Room_Only",
            "IsRefundable" => true,
            "WithTransfers" => false
        ],
        [
            "Name" => ["Double Or Twin Deluxe Executive", "Suite Deluxe"],
            "BookingCode" => "1256773!TB!2!TB!5f909d1f-c658-4be1-8831-32488c688f5f",
            "Inclusion" => "ROOM ONLY",
            "TotalFare" => 96.65,
            "TotalTax" => 0,
            "RoomPromotion" => [],
            "CancelPolicies" => [
                [
                    "Index" => "1",
                    "FromDate" => "16-12-2025 00:00:00",
                    "ChargeType" => "Percentage",
                    "CancellationCharge" => 100.0
                ],
                [
                    "Index" => "1",
                    "FromDate" => "21-01-2025 00:00:00",
                    "ChargeType" => "Fixed",
                    "CancellationCharge" => 0.0
                ],
                [
                    "Index" => "2",
                    "FromDate" => "16-12-2025 00:00:00",
                    "ChargeType" => "Percentage",
                    "CancellationCharge" => 100.0
                ],
                [
                    "Index" => "2",
                    "FromDate" => "21-01-2025 00:00:00",
                    "ChargeType" => "Fixed",
                    "CancellationCharge" => 0.0
                ]
            ],
            "MealType" => "Room_Only",
            "IsRefundable" => true,
            "WithTransfers" => false
        ],

    ];

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
        ];

        $requestData = array_merge($requestData, $this->request->request->all());

        echo "<pre>";
        print_r($requestData);
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

        // echo $response->getContent();

        $content = $response->toArray();

        if (isset($content['HotelResult'])) {
            $this->prebook = $content['HotelResult'];
        }

        $availableRooms = $this->prebook;
        require __DIR__ . '/../Views/preBookView.php';
    }
}
