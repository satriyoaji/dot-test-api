<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    public function search(Request $request)
    {
        $provinceId = $request->input('id');
        $province = Province::findOrFail($provinceId);
        if (!$province) {
            return new JsonResponse([
                'message' => "Data Province by id not found",
            ], 404);
        }
        return response()->json($province);
    }
}
