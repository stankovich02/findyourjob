<?php

namespace App\Http\Controllers\Client;

use App\Http\Requests\JobApplyRequest;
use App\Models\Application;

class ApplicationController extends Controller
{
    public function index(int $id)
    {
        $model = new Application();
        $application = $model->getApplication($id);
        return view('pages.client.application')->with('application', $application);
    }
    public function store(JobApplyRequest $request)
    {
        $model = new Application();
        $file = $request->file('uploadedFile');
        $coverLetter = $request->input('coverLetter');
        $jobID = $request->input('jobID');
        $userID = $request->session()->get('user')->id;
        $model->store($file,$coverLetter,$jobID,$userID);
        return redirect()->back()->with('success', 'Your application has been submitted successfully');
    }

}
