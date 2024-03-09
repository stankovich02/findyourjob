<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CompanyJobStatusMail;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class JobController extends Controller
{
    public function __construct(private readonly Job $jobModel = new Job())
    {
    }
    public function index() : View
    {
        $jobs = $this->jobModel->getAllAdmin();
        $pendingJobs = $this->jobModel->getPendingJobs();
        return view('pages.admin.jobs.index')->with('jobs', $jobs)->with('pendingJobs', $pendingJobs);
    }
    public function approve(int $id) : RedirectResponse
    {
        $data = $this->jobModel->approve($id);
        Mail::to($data['email'])->send(new CompanyJobStatusMail($data['jobName'], 'approved', $data['companyName']));
        return redirect()->route('admin.jobs.index')->with('success', 'Job approved successfully!');

    }
    public function show(int $id) : View
    {
        $job = $this->jobModel->getSingleJob($id);
        return view('pages.admin.jobs.show')->with('job', $job);
    }

    public function destroy($id) : RedirectResponse
    {
        $job = Job::find($id);
        $this->jobModel->deleteRow($id);
        Mail::to($job->company->email)->send(new CompanyJobStatusMail($job->name, 'rejected', $job->company->name));
        return redirect()->route('admin.jobs.index')->with('success', 'Job declined successfully!');
    }
}
