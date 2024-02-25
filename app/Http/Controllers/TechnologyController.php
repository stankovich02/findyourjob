<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Technology;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    public function getAll() : \Illuminate\Http\JsonResponse
    {
        $model = new Technology();
        $technologies = $model->all();
        return response()->json($technologies);
    }
}
