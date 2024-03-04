<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Job;

class HomeController extends DefaultController
{
    public function index() : \Illuminate\View\View
    {
       /* $time = now();
        $addHour = $time->addHour(1);
        $getHourFromDate = $time->hour;
        $getMinuteFromDate = $time->minute;
        dd($getHourFromDate, $getMinuteFromDate);*/
        parent::__construct();
        $catModel = new Category();
        $this->data['categories'] = $catModel->getAll();
        $jobModel = new Job();
        $jobs = $jobModel->getAll(true,[]);
        $this->data['jobs'] = $jobs["jobs"];
        return view('pages.client.home')->with('data', $this->data);
    }
}
