<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProvinceController extends Controller
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

        $provinceId = $request->input('id');

        if (strtolower($dataSource) === "remote") {
            return $this->searchRemote($provinceId);
        }
        return $this->searchDatabase($provinceId);
    }

    private function searchDatabase($requestId) {
        $province = Province::findOrFail($requestId);
        if (!$province) {
            return new JsonResponse([
                'message' => "Data Province by id not found",
            ], 404);
        }
        return response()->json([
            'data' => $province
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
        $responseProvince = $client->get('https://api.rajaongkir.com/starter/province?id='.$requestId, [
            'headers' => [
                'key' => $apiKey
            ]
        ]);

        $provinces = json_decode($responseProvince->getBody(), true);

        return new JsonResponse([
            'data' => $provinces['rajaongkir']['results'],
        ], $provinces['rajaongkir']['status']['code']);
    }
}
