<?php

namespace App\Http\Controllers\Client;

class HomeController extends DefaultController
{
    public function index()
    {
        return view('pages.client.home');
    }
}
