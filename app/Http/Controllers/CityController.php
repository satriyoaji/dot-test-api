<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $dataSource = env('DATA_SOURCE');
        if ($dataSource == "" || $dataSource == null) {
            return new JsonResponse([
                'message' => "DATA_SOURCE is must be set first",
            ], 400);
        }
        if (strtolower($dataSource) !== "remote" && strtolower($dataSource) !== "database") {
            return new JsonResponse([
                'message' => "DATA_SOURCE is must be set either `REMOTE` or `DATABASE` value",
            ], 400);
        }

        $cityId = $request->input('id');

        if (strtolower($dataSource) === "remote") {
            return $this->searchRemote($cityId);
        }
        return $this->searchDatabase($cityId);
    }

    private function searchDatabase($requestId) {
        $city = City::findOrFail($requestId);
        if (!$city) {
            return new JsonResponse([
                'message' => "Data City by id not found",
            ], 404);
        }
        return response()->json([
            'data' => $city
        ]);
    }

    private function searchRemote($requestId) {
        $client = new \GuzzleHttp\Client();
        $apiKey = env('RAJAONGKIR_API_KEY');
        if ($apiKey == null || $apiKey == "") {
            return new JsonResponse([
                'message' => "Error env var RAJAONGKIR_API_KEY not already set",
            ], 400);
        }
        $responseCity = $client->get('https://api.rajaongkir.com/starter/city?id='.$requestId, [
            'headers' => [
                'key' => $apiKey
            ]
        ]);

        $cities = json_decode($responseCity->getBody(), true);

        return new JsonResponse([
            'data' => $cities['rajaongkir']['results'],
        ], $cities['rajaongkir']['status']['code']);
    }
}
