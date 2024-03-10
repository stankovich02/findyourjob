<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CompanyJobStatusMail;
use App\Models\BoostedJob;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class JobController extends AdminController
{
    public function __construct(private readonly Job $jobModel = new Job())
    {
        parent::__construct();
    }
    public function index() : View
    {
        $jobs = $this->jobModel->getAllAdmin();
        return view('pages.admin.jobs.index')->with('jobs', $jobs)->with('active', $this->currentRoute);
    }

    public function pending() : View
    {
        $pendingJobs = $this->jobModel->getPendingJobs();
        return view('pages.admin.jobs.pending')->with('pendingJobs', $pendingJobs)->with('active', $this->currentRoute);
    }
    public function boosted() : View
    {
        $boostedJobs = $this->jobModel->getBoosted();
        return view('pages.admin.jobs.boosted')->with('boostedJobs', $boostedJobs)->with('active', $this->currentRoute);
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
        return view('pages.admin.jobs.show')->with('job', $job)->with('active', $this->currentRoute);
    }

    public function destroy($id) : RedirectResponse
    {
        $job = Job::find($id);
        $this->jobModel->deleteRow($id);
        Mail::to($job->company->email)->send(new CompanyJobStatusMail($job->name, 'rejected', $job->company->name));
        return redirect()->route('admin.jobs.index')->with('success', 'Job declined successfully!');
    }
    public function destroyBoosted(int $id) : RedirectResponse
    {
        try {
            $boostedJobModel = new BoostedJob();
            $boostedJobModel::destroy($id);
            return redirect()->route('admin.jobs.boosted')->with('success', 'Boosted job deleted successfully!');
        }
        catch (\Exception $e) {
            return redirect()->route('admin.jobs.boosted')->with('error', 'Error occurred while deleting boosted job!');
        }
    }
}
