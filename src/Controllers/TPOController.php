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

        echo $response->getContent();
    }
}
