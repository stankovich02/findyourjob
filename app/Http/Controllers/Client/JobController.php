<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\PostJobRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Seniority;
use App\Models\Technology;
use App\Models\Workplace;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('IsCompany')->except('index', 'show');
    }
    public function index()
    {
        $jobModel = new Job();
        $jobs = $jobModel->getAll();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        return view('pages.client.jobs.index')->with('jobs', $jobs)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $seniorities = Seniority::all();
        $workplaces= Workplace::all();
        $technologies = Technology::all();
        $companyModel = new Company();
        $companyLocations = $companyModel->getCompanyLocations(session()->get("user")->id);
        $data = [
            'categories' => $categories,
            'seniorities' => $seniorities,
            'workplaces' => $workplaces,
            'technologies' => $technologies,
            'companyLocations' => $companyLocations
        ];
        return view('pages.client.jobs.create')->with('data', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostJobRequest $request)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $seniority = $request->input('seniority');
        $workplace = $request->input('workplace');
        $technologies = $request->input('technologies');
        $description = $request->input('description');
        $responsibilities = $request->input('responsibilities');
        $requirements = $request->input('requirements');
        $benefits = $request->input('benefits');
        $location = $request->input('location');
        $salary = $request->input('salary');
        $workType = $request->input('workType');
        $applicationDeadline = $request->input('applicationDeadline');

        $jobModel = new Job();
        $jobModel->insert($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities, $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")->id);
        return "Job created successfully!";
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $jobModel = new Job();
        $job = $jobModel->getSingleJob($id);
        if ($job == null) {
            return redirect()->route('jobs.index');
        }
        if($job->status == Job::STATUS_EXPIRED || $job->status == Job::STATUS_PENDING){
            return redirect()->route('jobs.index');
        }
        return view('pages.client.jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $jobModel = new Job();
        $job = $jobModel->getSingleJob($id);
        if ($job == null) {
            return redirect()->route('jobs.index');
        }
        if(session()->get("user")->id != $job->company_id){
            return redirect()->route('jobs.index');
        }
        if($job->status == Job::STATUS_EXPIRED || $job->status == Job::STATUS_PENDING){
            return redirect()->route('jobs.index');
        }
        $categories = Category::all();
        $seniorities = Seniority::all();
        $workplaces= Workplace::all();
        $technologies = Technology::all();
        $companyModel = new Company();
        $companyLocations = $companyModel->getCompanyLocations(session()->get("user")->id);
        $data = [
            'job' => $job,
            'categories' => $categories,
            'seniorities' => $seniorities,
            'workplaces' => $workplaces,
            'technologies' => $technologies,
            'companyLocations' => $companyLocations
        ];
        return view('pages.client.jobs.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostJobRequest $request, int $id)
    {
        $name = $request->input('name');
        $category = $request->input('category');
        $seniority = $request->input('seniority');
        $workplace = $request->input('workplace');
        $technologies = $request->input('technologies');
        $description = $request->input('description');
        $responsibilities = $request->input('responsibilities');
        $requirements = $request->input('requirements');
        $benefits = $request->input('benefits');
        $location = $request->input('location');
        $salary = $request->input('salary');
        $workType = $request->input('workType');
        $applicationDeadline = $request->input('applicationDeadline');

        $jobModel = new Job();
        $jobModel->updateRow($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities,
            $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")
                ->id, $id);
        return "Job updated successfully!";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
