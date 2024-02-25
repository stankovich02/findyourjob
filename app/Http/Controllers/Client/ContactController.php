<?php

namespace App\Http\Controllers\Client;

class ContactController extends Controller
{
    public function index()
    {
        return view('pages.client.contact');
    }
}
