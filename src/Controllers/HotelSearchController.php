<?php

namespace AbdelrhmanSaeed\Tpo\Controllers;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};


class HotelSearchController
{

    private Request $request;
    private HttpClientInterface $client;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();
        $this->client  = HttpClient::createForBaseUri(
            'http://api.tbotechnology.in/', [
                'auth_basic' => [
                    $_ENV['AFRICAN_QUEEN_USERNAME'],
                    $_ENV['AFRICAN_QUEEN_PASSWORD']
                ],
        ]);
    }

    public function ok() {
        echo 'okok';
    }

    public function hotelSearchView(): void {
        require __DIR__ . '/../Views/hotelSearch.php';
    }

    public function hotelSearch(): Response
    {
        $hotelSearchHistory = $this->getHotelSearchHistoryFromFirebase();
        $location           = explode(',', $hotelSearchHistory['location']);
        $cityCode           = null;

        foreach ($this->getCountryCities($location[1]) as $city) {
            if ($city['Name'] == $location[0]) $cityCode = $city['Code'];
        }

        if (is_null($cityCode)) {
            new Response("error: city name '{$city['Name']}' is not valid!", 400);
        }

        $hotelsResponse = $this->getHotelsInCity($cityCode);

        if ($hotelsResponse['Status']['Code'] !== 200) {
            return new Response($hotelsResponse['Status']['Description'], $hotelsResponse['Status']['Code']);
        }

        return $this->storeHotelSreachHistoryToFishbase($hotelsResponse['HotelSearchResults']);
    }

    private function getHotelSearchHistoryFromFirebase(): array
    {
        $response = $this->client->request(
            'GET', 'https://echoes-travel-default-rtdb.firebaseio.com/hotel_searches.json');

        $response = json_decode($response->getContent(), true);

        return (array) end($response);
    }

    public function storeHotelSreachHistoryToFishbase(array $hotelSearchResult): Response
    {

        $response = $this->client->request(
            'POST',
            'https://echoes-travel-default-rtdb.firebaseio.com/hotel_searches_results.json', [
                    'json' => $hotelSearchResult
                ]
        );

        return new Response( $response->getContent(), $response->getStatusCode() );
    }

    private function getCountryCities(string $countryCode): array
    {
        $response = $this->client->request('POST', 'TBOHolidays_HotelAPI/CityList', [
            'json' => ['CountryCode' => $countryCode]
        ]);

        return json_decode($response->getContent(), true)['CityList'];
    }

    private function getHotelsInCity(string $cityCode): array
    {
        $incomingData = json_decode($this->request->getContent(), true);
        $incomingData = array_merge($incomingData, $this->getHotelsInCityRequestStaticData());

        $incomingData['CityCode'] = $cityCode;
        $incomingData['Filters']['NoOfRooms'] = count($incomingData['PaxRooms']);

        $response = $this->client->request('POST', '/TBOHolidays_HotelAPI/HotelSearch', [
            'json' => $incomingData
        ]);

        return json_decode($response->getContent(), true);
    }

    private function getHotelsInCityRequestStaticData(): array
    {
        return [
            "HotelCodes"            => "",
            "GuestNationality"      => "EG",
            "PreferredCurrencyCode" => "EGP",
            "IsDetailResponse"      => true,
            "ResponseTime"          => 23,
            "Filters" => [
                "MealType"      => "All",
                "Refundable"    => "true",
            ]
        ];
    }


}