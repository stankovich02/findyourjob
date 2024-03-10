<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthorController extends DefaultController
{
    public function index()
    {
        parent::__construct();
        return view('pages.client.author')->with('data', $this->data);
    }
}
