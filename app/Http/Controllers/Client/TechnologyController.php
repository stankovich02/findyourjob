<?php

namespace App\Http\Controllers\Client;

use App\Models\Technology;

class TechnologyController extends Controller
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        $model = new Technology();
        $technologies = $model->all();
        return response()->json($technologies);
    }
}
