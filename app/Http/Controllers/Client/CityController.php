<?php

namespace App\Http\Controllers\Client;

use App\Models\City;

class CityController extends DefaultController
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        try {
            $model = new City();
            $cities = $model->getAll();
            return response()->json($cities);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['errors' => "An error occurred while getting cities"], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
