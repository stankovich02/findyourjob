<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\JobApplyRequest;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ApplicationController extends DefaultController
{

    public function __construct(private readonly Application $applicationModel = new Application())
    {
        parent::__construct();
    }
    public function index(int $id) : View|RedirectResponse
    {
        parent::__construct();
        $application = $this->applicationModel->getApplication($id);
        if(session()->get('accountType') == 'employee'){
            if($application->user_id != session()->get('user')->id){
                return redirect()->route('home');
            }
        }
        if($application->job->company_id != session()->get('user')->id){
            return redirect()->route('home');
        }
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
    public function destroy(int $id) : RedirectResponse
    {
        try
        {
            $jobID = $this->applicationModel->getApplication($id)->job_id;
            $jobName = Job::where('id', $jobID)->first()->name;
            $this->applicationModel->deleteApplication($id);
            $this->logUserAction('User removed application for a ' . $jobName . ' (id: ' . $jobID . ') job.', request());
            return redirect()->route('jobs.show', $jobID)->with('success', 'Application has been removed successfully.');
        }
        catch (\Exception $e){
            return redirect()->back()->with('error', 'An error occurred while deleting the application. Please try again later.');
        }
    }

}
