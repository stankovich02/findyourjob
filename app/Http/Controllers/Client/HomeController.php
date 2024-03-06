<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Job;
use App\Models\Newsletter;

class HomeController extends DefaultController
{
    public function index() : \Illuminate\View\View
    {
        parent::__construct();
        $catModel = new Category();
        $this->data['categories'] = $catModel->getAll();
        $jobModel = new Job();
        $jobs = $jobModel->getAll(true,[]);
        $this->data['jobs'] = $jobs;
        return view('pages.client.home')->with('data', $this->data);
    }
}
