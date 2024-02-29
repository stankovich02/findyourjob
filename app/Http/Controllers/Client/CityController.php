<?php

namespace App\Http\Controllers\Client;

use App\Models\City;

class CityController extends DefaultController
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        $model = new City();
        $cities = $model->getAll();
        return response()->json($cities);
    }
}
