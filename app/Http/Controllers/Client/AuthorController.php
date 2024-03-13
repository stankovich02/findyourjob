<?php

namespace App\Http\Controllers\Client;

class AuthorController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.author')->with('data', $this->data);
    }
}
