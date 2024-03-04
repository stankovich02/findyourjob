<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\PostJobRequest;
use App\Models\Category;
use App\Models\Company;
use App\Models\Job;
use App\Models\Seniority;
use App\Models\Technology;
use App\Models\Workplace;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class JobController extends DefaultController
{
    private Job $jobModel;
    private Company $companyModel;
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        parent::__construct();
        $this->companyModel = new Company();
        $this->jobModel = new Job();
        $this->middleware('IsCompany')->except('index', 'show', 'save', 'filter');
    }
    public function index() : View
    {
        parent::__construct();
        $jobs = $this->jobModel->getAll();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        return view('pages.client.jobs.index')->with('jobs', $jobs["jobs"])->with('countJobs', $jobs["countJobs"])->with('categories', $categories)->with('data', $this->data);
    }

    public function filter(Request $request) : JsonResponse
    {
        $array = [];
        $array['keyword'] = $request->input('keyword');
        if($request->has('cities')){
            $array['cities'] = $request->input('cities');
        }
        if($request->has('technologies')){
            $array['technologies'] = $request->input('technologies');
        }
        $array['category'] = $request->input('category');
        $array['seniority'] = $request->input('seniority');
        $array['workplace'] = $request->input('workplace');
        $array['salary'] = $request->input('salary');
        $array['workType'] = $request->input('workType');
        if($request->input('latestJobs') == "true"){
            $jobs = $this->jobModel->getAll(true,$array);
        }
        else{
            $jobs = $this->jobModel->getAll(false,$array);
        }

        $clientResponse = [
            'jobs' => $jobs['jobs'],
            'html' => []
        ];
        foreach ($jobs["jobs"] as $job){
            $clientResponse['html'][] = view('pages.client.jobs.partials.job', ['job' => $job])->render();
        }
        return response()->json($clientResponse);
    }

    public function save(int $id) : JsonResponse
    {
        try {
            $userID = session()->get("user")->id;
            return $this->jobModel->saveJob($id, $userID);
        }
        catch (\Exception $e){
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() : View|RedirectResponse
    {
        parent::__construct();
        $company = $this->companyModel->getCompany(session()->get("user")->id);
        if($company->logo == 'user.jpg')
        {
            return redirect()->route('home')->with('companyError', 'Please upload a logo before creating a job!');
        }

        $categories = Category::all();
        $seniorities = Seniority::all();
        $workplaces= Workplace::all();
        $technologies = Technology::all();
        $companyModel = new Company();
        $companyLocations = $companyModel->getCompanyLocations(session()->get("user")->id);
        $array = [
            'categories' => $categories,
            'seniorities' => $seniorities,
            'workplaces' => $workplaces,
            'technologies' => $technologies,
            'companyLocations' => $companyLocations
        ];
        return view('pages.client.jobs.create')->with('array', $array)->with('data', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostJobRequest $request) : JsonResponse
    {
        try {
            DB::beginTransaction();
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
            $this->jobModel->insert($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities, $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")->id);
            DB::commit();
            return response()->json(['message' => 'Job created successfully! Please wait for the admin to approve it!'], ResponseAlias::HTTP_CREATED);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : View|RedirectResponse
    {
        parent::__construct();
        $jobModel = new Job();
        $job = $jobModel->getSingleJob($id);
        if ($job == null) {
            return redirect()->route('jobs.index');
        }
        if($job->status == Job::STATUS_EXPIRED || $job->status == Job::STATUS_PENDING){
            return redirect()->route('jobs.index');
        }
        return view('pages.client.jobs.show')->with('job', $job)->with('data', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) : View|RedirectResponse
    {
        parent::__construct();
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
        $array = [
            'job' => $job,
            'categories' => $categories,
            'seniorities' => $seniorities,
            'workplaces' => $workplaces,
            'technologies' => $technologies,
            'companyLocations' => $companyLocations
        ];
        return view('pages.client.jobs.edit')->with('array', $array)->with('data', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostJobRequest $request, int $id) : JsonResponse|Response
    {
        try {
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
            $this->jobModel->updateRow($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities,
                $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")
                    ->id, $id);
            return response(null,ResponseAlias::HTTP_OK);
        }
        catch (\Exception $e){
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse|Response
    {
        try {
            DB::beginTransaction();
            $this->jobModel->deleteRow($id);
            DB::commit();
            return response(null, ResponseAlias::HTTP_NO_CONTENT);
        }
        catch (\Exception $e){
            DB::rollBack();
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
