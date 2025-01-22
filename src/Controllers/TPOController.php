<?php

namespace AbdelrhmanSaeed\Tpo\Controllers;

use Symfony\Component\HttpFoundation\{Request, Response};


class TPOController
{
    private Request $request;
    private Response $response;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->response = new Response();
    }

    public function hotelSearchView(): void {
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
}