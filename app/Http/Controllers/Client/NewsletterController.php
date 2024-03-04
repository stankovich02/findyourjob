<?php

namespace App\Http\Controllers\Client;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class NewsletterController extends DefaultController
{
    public function store(Request $request) : \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        try {
            $model = new Newsletter();
            return $model->insert($request->email);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred.'], ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
