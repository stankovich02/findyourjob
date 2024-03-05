<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\JobApplyRequest;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends DefaultController
{
    private Application $applicationModel;

    public function __construct()
    {
        parent::__construct();
        $this->applicationModel = new Application();
    }
    public function index(int $id) : View
    {
        parent::__construct();
        $application = $this->applicationModel ->getApplication($id);
        return view('pages.client.application')->with('application', $application)->with('data', $this->data);
    }
    public function store(JobApplyRequest $request) : RedirectResponse
    {
        try
        {
            $file = $request->file('uploadedFile');
            $coverLetter = $request->input('coverLetter');
            $jobID = $request->input('jobID');
            $jobName = Job::where('id', $jobID)->first()->name;
            $userID = $request->session()->get('user')->id;
            $this->applicationModel->store($file,$coverLetter,$jobID,$userID);
            $this->logUserAction('User applied for a ' . $jobName . ' (id: ' . $jobID . ') job.', $request);
            return redirect()->back()->with('success', 'Your application has been submitted successfully');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while submitting your application. Please try again later.');
        }
    }

}
