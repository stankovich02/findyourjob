<?php

namespace App\Http\Controllers\Admin;

use App\Mail\CompanyJobStatusMail;
use App\Models\BoostedJob;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class JobController extends AdminController
{
    public function __construct(private readonly Job $jobModel = new Job())
    {
        parent::__construct();
    }
    public function index() : View|RedirectResponse
    {
        try{
            $data = [
                'title' => 'Jobs',
                'entityName' => 'Job',
                'route' => 'admin.jobs',
                'columns' => Schema::getColumnListing('jobs'),
                'values' => $this->jobModel->getAllAdmin()
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }

    public function pending() : View|RedirectResponse
    {
        try{
            $data = [
                'title' => 'Pending Jobs',
                'entityName' => 'Pending Job',
                'route' => 'admin.jobs',
                'columns' => Schema::getColumnListing('jobs'),
                'values' => $this->jobModel->getPendingJobs()
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }
    public function boosted() : View|RedirectResponse
    {
        try {
            $boostedModel = new BoostedJob();
            $data = [
                'title' => 'Boosted Jobs',
                'entityName' => 'BoostedJob',
                'route' => 'admin.jobs',
                'columns' => Schema::getColumnListing('boosted_jobs'),
                'values' => $boostedModel::with('job')->paginate(5)
            ];
            return view('pages.admin.index')->with('active', $this->currentRoute)
                ->with('data', $data);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.dashboard')->with('error', 'An error occurred.');
        }
    }
    public function approve(int $id) : RedirectResponse
    {
        try{
            $data = $this->jobModel->approve($id);
            Mail::to($data['email'])->send(new CompanyJobStatusMail($data['jobName'], 'approved', $data['companyName']));
            return redirect()->route('admin.jobs.index')->with('success', 'Job approved successfully!');

        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.jobs.index')->with('error', 'An error occurred.');
        }

    }
    public function show(int $id) : View|RedirectResponse
    {
        try {
        $job = $this->jobModel->getSingleJob($id);
        return view('pages.admin.jobs.show')->with('job', $job)->with('active', $this->currentRoute);
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.jobs.index')->with('error', 'An error occurred.');
        }
    }

    public function destroy($id) : RedirectResponse
    {
        try {
            $job = $this->jobModel->getSingleJob($id);
            $this->jobModel->deleteRow($id);
            Mail::to($job->company->email)->send(new CompanyJobStatusMail($job->name, 'rejected', $job->company->name));
            return redirect()->route('admin.jobs.index')->with('success', 'Job declined successfully!');
        } catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.jobs.index')->with('error', 'An error occurred.');
        }
    }
    public function destroyBoosted(int $id) : RedirectResponse
    {
        try {
            $boostedJobModel = new BoostedJob();
            $boostedJobModel::destroy($id);
            return redirect()->route('admin.jobs.boosted')->with('success', 'Boosted job deleted successfully!');
        }
        catch (\Exception $e) {
            $this->LogError($e->getMessage(), $e->getTraceAsString());
            return redirect()->route('admin.jobs.boosted')->with('error', 'Error occurred while deleting boosted job!');
        }
    }
}
