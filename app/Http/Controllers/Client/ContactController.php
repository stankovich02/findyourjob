<?php

namespace App\Http\Controllers\Client;

class ContactController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.contact')->with('data', $this->data);
    }
}
