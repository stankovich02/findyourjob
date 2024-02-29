@extends('layouts.layout')
@section('title') Jobs @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
<!-- Jobs Start -->
<div class="container-xxl py-5">
    <div class="container">
        <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Job Listing</h1>
        <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
            <!-- Search Start -->
            <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
                <div class="container">
                    <div class="row g-2">
                        <div class="col-md-10">
                            <form data-action="{{route("jobs.filter")}}">
                            <div class="row g-2">

                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobKeyword" class="form-label text-white jobSearchLabel">Keyword:</label>
                                    <input type="text" id="jobKeyword" class="form-control border-0"/>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobCity" class="form-label text-white jobSearchLabel">Search by city:</label>
                                    {{--<input type="text" id="jobCity" class="form-control border-0"/>--}}
                                    <div id="Cities"></div>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobTechnologies" class="form-label text-white jobSearchLabel">Search by technology:</label>
                                    {{--<input type="text" id="jobCity" class="form-control border-0"/>--}}
                                    <div id="Technologies"></div>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobCategory" class="form-label text-white jobSearchLabel">Job Category:</label>
                                    <select class="form-select border-0" id="jobCategory">
                                        <option value="0">All</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach()
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobSeniority" class="form-label text-white jobSearchLabel">Seniority:</label>
                                    <select class="form-select border-0" id="jobSeniority">
                                        <option value="0">All</option>
                                        <option value="1">Junior</option>
                                        <option value="2">Medior</option>
                                        <option value="3">Senior</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="workType" class="form-label text-white jobSearchLabel">Work type:</label>
                                    <select class="form-select border-0" id="workType">
                                        <option value="both">Both</option>
                                        <option value="0">Part Time</option>
                                        <option value="1">Full Time</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex flex-column">
                                    <label for="workPlace" class="form-label text-white jobSearchLabel">Workplace:</label>
                                    <select class="form-select border-0" id="workPlace">
                                        <option value="0">All</option>
                                        <option value="1">Hybrid</option>
                                        <option value="2">Office</option>
                                        <option value="3">Remote</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex align-items-center  justify-content-center">
                                    <div id="salaryDiv" class="d-flex align-items-center">
                                        <label for="jobSalary" class="form-label text-white jobSearchLabel me-3">Salary:</label>
                                        <input type="checkbox" class="form-control font-small" id="jobSalary" name="jobSalary" />
                                    </div>
                                </div>
                                <div class="col-md-4 d-flex align-items-center  justify-content-center">
                                    <div id="newJobsDiv" class="d-flex align-items-center">
                                        <label for="latestJobs" class="form-label text-white jobSearchLabel me-3">Latest jobs:</label>
                                        <input type="checkbox" class="form-control font-small" id="latestJobs" name="latestJobs" />
                                    </div>
                                </div>

                            </div>
                            </form>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-dark border-0 w-100" id="filterJobs">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search End -->
            <div class="tab-content">
                <div id="allJobs" class="tab-pane fade show p-0 active">
                    @foreach($jobs as $job)
                        @include("pages.client.jobs.partials.job")
                    @endforeach
                    <nav aria-label="..." class="d-flex justify-content-center mt-5">
                        <ul class="pagination pagination-sm">
                            @for ($i = 1; $i <= count($jobs); $i++)
                                @if ($i === 1)
                                <li class="page-item active" aria-current="page">
                                    <span class="page-link px-3 py-2">{{$i}}</span>
                                </li>
                                @else
                                <li class="page-item"><a class="page-link px-3 py-2 pageLink" href="">{{$i}}</a></li>
                                @endif
                            @endfor
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Jobs End -->
<div class="modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <p></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" id="deleteModal" >Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection
