<?php

namespace App\Http\Controllers\Client;

use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends DefaultController
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $model = new Newsletter();
        return $model->insert($request->email);
    }
}
