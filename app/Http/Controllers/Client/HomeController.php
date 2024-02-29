<?php

namespace App\Http\Controllers\Client;

class HomeController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.home')->with('data', $this->data);
    }
}
