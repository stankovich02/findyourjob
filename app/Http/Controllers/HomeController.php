<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends DefaultController
{
    public function index()
    {
        return view('pages.client.home');
    }
}
