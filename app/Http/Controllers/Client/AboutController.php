<?php

namespace App\Http\Controllers\Client;

use Illuminate\View\View;

class AboutController extends DefaultController
{
    public function index() : View
    {
        parent::__construct();
        return view('pages.client.about')->with('data', $this->data);
    }
}
