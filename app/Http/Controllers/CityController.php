<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $cityId = $request->input('id');
        $city = City::findOrFail($cityId);
        if (!$city) {
            return new JsonResponse([
                'message' => "Data City by id not found",
            ], 404);
        }
        return response()->json($city);
    }
}
