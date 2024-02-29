<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\JobApplyRequest;
use App\Models\Application;

class ApplicationController extends DefaultController
{
    private Application $applicationModel;

    public function __construct()
    {
        parent::__construct();
        $this->applicationModel = new Application();
    }
    public function index(int $id)
    {
        parent::__construct();
        $application = $this->applicationModel ->getApplication($id);
        return view('pages.client.application')->with('application', $application)->with('data', $this->data);
    }
    public function store(JobApplyRequest $request)
    {
        $file = $request->file('uploadedFile');
        $coverLetter = $request->input('coverLetter');
        $jobID = $request->input('jobID');
        $userID = $request->session()->get('user')->id;
        $this->applicationModel->store($file,$coverLetter,$jobID,$userID);
        return redirect()->back()->with('success', 'Your application has been submitted successfully');
    }

}
