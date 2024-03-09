<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\PostJobRequest;
use App\Models\BoostedJob;
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
use Stripe\Stripe;
use Stripe\Charge;

class JobController extends DefaultController
{
    public function __construct(private readonly Job $jobModel = new Job(), private readonly Company $companyModel =
    new Company())
    {
        parent::__construct();
        $this->middleware('IsCompany')->except('index', 'show', 'save', 'filter');
    }
    /**
     * Display a listing of the resource.
     */
    public function index() : View|RedirectResponse
    {
        parent::__construct();
        try {
            $jobs = $this->jobModel->getAll();
            $this->data['categories'] = Category::all();
            $this->data['seniorities'] = Seniority::all();
            $this->data['workplaces'] = Workplace::all();
            return view('pages.client.jobs.index')->with('jobs', $jobs)->with('data', $this->data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    public function filter(Request $request) : JsonResponse
    {
        try {
            $array = [];
            $array['keyword'] = $request->input('keyword');
            if ($request->has('cities')) {
                $array['cities'] = $request->input('cities');
            }
            if ($request->has('technologies')) {
                $array['technologies'] = $request->input('technologies');
            }
            $array['category'] = $request->input('category');
            $array['seniority'] = $request->input('seniority');
            $array['workplace'] = $request->input('workplace');
            $array['salary'] = $request->input('salary');
            $array['workType'] = $request->input('workType');
            if ($request->input('latestJobs') == "true") {
                $jobs = $this->jobModel->getAll(true, $array);
            } else {
                $jobs = $this->jobModel->getAll(false, $array);
            }

            $clientResponse = [
                'jobs' => $jobs,
                'html' => []
            ];
            foreach ($jobs as $job) {
                $clientResponse['html'][] = view('components.job', ['job' => $job])->render();
            }
            return response()->json($clientResponse);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['errors' => "An error occurred while getting cities"], \Symfony\Component\HttpFoundation\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function boost(Request $request, int $id) : RedirectResponse
    {
        Stripe::setApiKey('sk_test_51Or1PM08Wg9T2v5dDlLfT8fpvg9vH1gguxfkVVw3Dz6oZUER3916sHfs2D15boh728y1lbKCvViiyhOMffkRpyNL00fM6FlKbt');

        if (!$request->has('stripeToken')) {
            return redirect()->back()->with('boostError', 'Token not provided!');
        }
        $token = $request->stripeToken;
        $amount = 1000;
        $currency = 'eur';
        try {
            $charge = Charge::create([
                'amount' => $amount,
                'currency' => $currency,
                'source' => $token,
                'description' => 'Test payment'
            ]);
            $durationBoost = $request->input('duration');
            $total = $request->input('total');
            $jobID = $id;
            $boostedJobsModel = new BoostedJob();
            $boostedJobsModel->insert($jobID, $durationBoost, $total);
            $stringDays = $durationBoost == 1 ? ' day' : ' days';
            $this->logUserAction('Company boosted a job (id: ' . $jobID . ') for ' . $durationBoost . $stringDays
                . '.',
                $request);
            return redirect()->back()->with('boostSuccess', 'Payment processed successfully. Your job is now boosted!');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('boostError', $e->getMessage());
        }
    }

    public function save(int $id) : JsonResponse
    {
        try {
            $userID = session()->get("user")->id;
            return $this->jobModel->saveJob($id, $userID);
        }
        catch (\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create() : View|RedirectResponse
    {
        try {
            parent::__construct();
            $company = $this->companyModel->getCompany(session()->get("user")->id);
            if ($company->logo == 'user.jpg') {
                return redirect()->route('home')->with('companyError', 'Please upload a logo before creating a job!');
            }
            $categories = Category::all();
            $seniorities = Seniority::all();
            $workplaces = Workplace::all();
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
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
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
            $jobID = $this->jobModel->insert($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities, $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")->id);
            $this->logUserAction('Company posted a ' . $name . ' (id: ' . $jobID . ') job.', $request);
            DB::commit();
            return response()->json(['message' => 'Job created successfully! Please wait for the admin to approve it!'], ResponseAlias::HTTP_CREATED);
        }
        catch (\Exception $e)
        {
            DB::rollBack();
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id) : View|RedirectResponse|JsonResponse
    {
        try{
        parent::__construct();
        $jobModel = new Job();
        $job = $jobModel->getSingleJob($id);
        if ($job == null) {
            return redirect()->route('jobs.index');
        }
        if($job->status == Job::STATUS_EXPIRED || $job->status == Job::STATUS_PENDING){
            return redirect()->route('jobs.index');
        }
        if(\request()->ajax() && \request()->isMethod('get')){
           return response()->json(['job' => $job]);
        }
        return view('pages.client.jobs.show')->with('job', $job)->with('data', $this->data);
        }
        catch (\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id) : View|RedirectResponse
    {
        parent::__construct();
        try {
            $jobModel = new Job();
            $job = $jobModel->getSingleJob($id);
            if ($job == null) {
                return redirect()->route('jobs.index');
            }
            if (session()->get("user")->id != $job->company_id) {
                return redirect()->route('jobs.index');
            }
            if ($job->status == Job::STATUS_EXPIRED || $job->status == Job::STATUS_PENDING) {
                return redirect()->route('jobs.index');
            }
            $categories = Category::all();
            $seniorities = Seniority::all();
            $workplaces = Workplace::all();
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
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->back()->with('error', 'An error occurred.');
        }
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
            $jobID = $this->jobModel->updateRow($name, $category, $seniority, $workplace, $technologies, $description, $responsibilities,
                $requirements, $benefits, $location, $salary, $workType, $applicationDeadline, session()->get("user")
                    ->id, $id);
            if ($jobID == 0) {
                return response()->json(['error' => 'Job not found!'], ResponseAlias::HTTP_NOT_FOUND);
            }
            $this->logUserAction('Company edited a (id: ' . $jobID . ') job.', $request);
            return response(null,ResponseAlias::HTTP_OK);
        }
        catch (\Exception $e){
            $this->LogError($e->getMessage(), $e->getTraceAsString());
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
            $this->logUserAction('Company deleted a job (id: ' . $id . ').', request());
            return response(null, ResponseAlias::HTTP_NO_CONTENT);
        }
        catch (\Exception $e){
            DB::rollBack();
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return response()->json(['error' => 'An error occurred! Please try again later!'],
                ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
