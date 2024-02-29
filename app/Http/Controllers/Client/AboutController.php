<?php

namespace App\Http\Controllers\Client;

class AboutController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.about')->with('data', $this->data);
    }
}
