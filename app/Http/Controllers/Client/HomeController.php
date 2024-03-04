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
        $this->data['jobs'] = $jobModel->getAll(true,[]);
        return view('pages.client.home')->with('data', $this->data);
    }
}
