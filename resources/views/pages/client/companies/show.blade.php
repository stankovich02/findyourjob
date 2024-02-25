@extends('layouts.layout')
@section('title') {{$company->name}} @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div id="company-wrapper" class="w-75 py-5 mx-auto">
        <div id="logo" class="text-center">
            <img src="{{asset('assets/img/companies/' . $company->logo)}}" alt="logo">
        </div>
        <h3 class="text-center font-xl pt-3 pd-0">{{$company->name}}</h3>
        <div class="text-center mb-5">
            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>
            @foreach($company->cities as $city)
                {{$city->name}}
                @if(!$loop->last)
                    ,
                @endif
            @endforeach
            </span>
            <span class="text-truncate me-3"><i class="fa fa-envelope text-primary me-2"></i>{{$company->email}}</span>
            <span class="text-truncate me-3"><i class="fa fa-phone text-primary me-2"></i>{{$company->phone}}</span>
        </div>
        <h3 class="font-xl py-3">About {{$company->name}}</h3>
        <p class="font-small">{{$company->description}}</p>
        <h3 class="font-xl pt-5">Jobs</h3>
        @foreach($company->jobs as $job)
            <div class="job-item p-4 mb-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{asset("assets/img/companies/" . $company->logo)}}" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h5 class="mb-3">{{$job->name}}</h5>
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
                                <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
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
            <!-- Jobs End -->
        @endforeach

    </div>
@endsection
