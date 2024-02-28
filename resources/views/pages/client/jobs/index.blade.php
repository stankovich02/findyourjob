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
                                        <option value="0">Both</option>
                                        <option value="1">Full Time</option>
                                        <option value="2">Part Time</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="workPlace" class="form-label text-white jobSearchLabel">Workplace:</label>
                                    <select class="form-select border-0" id="workPlace">
                                        <option value="0">All</option>
                                        <option value="1">Hybrid</option>
                                        <option value="2">Office</option>
                                        <option value="3">Remote</option>
                                    </select>
                                </div>
                                <div class="col-md-4 d-flex flex-column align-items-start">
                                    <label for="jobSalary" class="form-label text-white jobSearchLabel">Salary:</label>
                                   <select class="form-select border-0" id="jobSalary">
                                        <option value="0">All</option>
                                        <option value="2">Yes</option>
                                        <option value="3">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button class="btn btn-dark border-0 w-100">Search</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Search End -->
            <div class="tab-content">
                <div id="tab-1" class="tab-pane fade show p-0 active">
                    @foreach($jobs as $job)
                        <div class="job-item p-4 mb-4 position-relative">
                            @if((session()->has("user")) && (session()->get("accountType") == "company") && ($job->company_id == session()->get("user")->id))
                                <div class="deleteJob">
                                    <a href="" class="btn btn-danger" data-id="{{$job->id}}">X</a>
                                </div>
                            @endif
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <a href="{{route("companies.show", $job->company->id)}}"><img class="flex-shrink-0 img-fluid border rounded" src="{{asset("assets/img/companies/" . $job->company->logo)}}" alt="" style="width: 80px; height: 80px;"></a>
                                    <div class="text-start ps-4">
                                        <a href="{{route("jobs.show", $job->id)}}"><h5 class="mb-3 jobName">{{$job->name}}</h5></a>
                                        <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city->name}}</span>
                                        <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$job->full_time ? "Full time" : "Part-time"}}</span>
                                        <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>{{$job->seniority->name}}</span>

                                        @if($job->salary)
                                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{$job->salary}}&euro;</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        @if(session()->has("user") && session()->get("accountType") == "employee")
                                            @if($job->saved_jobs->where("id", session()->get("user")->id)->first())
                                                <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$job->id}}" href=""><i class="fas fa-heart text-primary"></i></a>
                                            @else
                                                <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$job->id}}" href=""><i class="far fa-heart text-primary"></i></a>
                                            @endif
                                        @endif
                                        @if(session()->has("user") && session()->get("accountType") == "employee" && $job->applications->where("user_id", session()->get("user")->id)->first())
                                                <a class="btn btn-muted" href="{{route("jobs.show", $job->id)}}">Applied</a>
                                        @elseif(!session()->has("user") || (session()->has("user") && session()->get("accountType") == "employee"))
                                            <a class="btn btn-primary" href="{{route("jobs.show", $job->id)}}">Apply Now</a>
                                        @else
                                            <a class="btn btn-primary" href="{{route("jobs.show", $job->id)}}">View job</a>
                                        @endif

                                    </div>
                                    <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{date('d/m/Y', strtotime($job->application_deadline))}}</small>
                                </div>
                                <div class="col-12">
                                    <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                        @if($job->technology)
                                            @foreach($job->technology as $technology)
                                                <span class="badge bg-primary me-2">{{$technology->name}}</span>
                                            @endforeach
                                            <span class="badge bg-primary me-2">{{$job->seniority->name}}</span>
                                        @else
                                            <span class="badge bg-primary me-2">{{$job->seniority->name}}</span>
                                        @endif
                                        {{--<span class="badge bg-primary me-2">Leader</span>--}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <nav aria-label="..." class="d-flex justify-content-center mt-5">
                        <ul class="pagination pagination-sm">
                            <li class="page-item active" aria-current="page">
                                <span class="page-link px-3 py-2">1</span>
                            </li>
                            <li class="page-item"><a class="page-link px-3 py-2" href="#">2</a></li>
                            <li class="page-item"><a class="page-link px-3 py-2" href="#">3</a></li>
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
