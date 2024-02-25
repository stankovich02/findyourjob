<?php

namespace App\Http\Controllers\Client;

use App\Models\Category;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->middleware('IsCompany')->except('index', 'show');
    }
    public function index()
    {
        $jobModel = new Job();
        $jobs = $jobModel->getAll();
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();
        return view('pages.client.jobs.index')->with('jobs', $jobs)->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('pages.client.jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $jobModel = new Job();
        $job = $jobModel->getSingleJob($id);
        return view('pages.client.jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
