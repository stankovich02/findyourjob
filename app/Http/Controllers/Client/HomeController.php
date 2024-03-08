<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Newsletter;
use App\Models\Technology;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
    public function search(Request $request) : JsonResponse
    {
        $keyword = $request->input('search');
        $jobs = Job::where('name', 'like', '%' . $keyword . '%')->get();
        $companies = Company::where('name', 'like', '%' . $keyword . '%')->get();
        $technologies = Technology::where('name', 'like', '%' . $keyword . '%')->get();
        $arrayForReturn = [];
        foreach ($jobs as $job){
            $arrayForReturn[] = [
                'id' => $job->id,
                'name' => $job->name,
                'type' => 'job',
                'link' => route('jobs.index'),
                'text' => 'search by job title',
                'icon' => 'fas fa-briefcase'
            ];
        }
        foreach ($companies as $company){
            $arrayForReturn[] = [
                'id' => $company->id,
                'name' => $company->name,
                'type' => 'company',
                'link' => route('companies.show', $company->id),
                'text' => 'company',
                'icon' => 'fas fa-building'
            ];
        }
        foreach ($technologies as $technology){
            $arrayForReturn[] = [
                'id' => $technology->id,
                'name' => $technology->name,
                'type' => 'technology',
                'link' => route('jobs.index'),
                'text' => 'search by technology',
                'icon' => 'fas fa-code'
            ];
        }
        return response()->json($arrayForReturn);
    }
}
