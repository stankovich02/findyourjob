<?php

namespace App\Http\Controllers\Client;

class AboutController extends Controller
{
    public function index()
    {
        return view('pages.client.about');
    }
}
