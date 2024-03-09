<?php

namespace App\Http\Controllers\Client;

use App\Models\Technology;

class TechnologyController extends DefaultController
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        try {
            $model = new Technology();
            $technologies = $model->all();
            return response()->json($technologies);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['errors' => "An error occurred while getting technologies"], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
