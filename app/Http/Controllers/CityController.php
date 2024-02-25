<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        $model = new City();
        $cities = $model->getAll();
        return response()->json($cities);
    }
}
