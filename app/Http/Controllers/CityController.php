<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function search(Request $request)
    {
        $cityId = $request->input('id');
        $city = City::findOrFail($cityId);
        if (!$city) {
            response()->json()->status(404);
        }
        return response()->json($city);
    }
}
