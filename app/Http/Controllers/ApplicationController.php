<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobApplyRequest;
use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function index()
    {
        return view('pages.client.application');
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

    public function show($id)
    {
        $model = new Application();
        $application = $model->getApplication($id);
        return view('pages.client.application')->with('application', $application);
    }
}
