@extends('layouts.layout')
@section('title') Account @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
<div class="container-xl px-4 mt-5">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    @if(session('accountType') === 'employee')
                    <img class="img-account-profile rounded-circle mb-2 img-fluid" src="{{asset('assets/img/users/' . session('user')->avatar)}}" alt="">
                    @else
                    <img class="img-account-profile rounded-circle mb-2 img-fluid" src="{{asset('assets/img/companies/' . session('user')->logo)}}" alt="">
                    @endif
                        <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
            @if(session('accountType') === 'employee')
            <div id="profileLinks" class="mt-4">
                <h5 class="font-xl">Profile Links:</h5>
                @if(session('user')->github)
                <div class="d-flex align-items-center mb-2 justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-github fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between justify-content-between w-100 ms-3 align-items-center">
                        <a href="{{session('user')->github}}">{{session('user')->github}}</a>
                        <button class="btn btn-primary btn-sm ms-2 changeLink">Change</button>
                    </div>
                </div>
                @else
                <div class="d-flex align-items-center mb-2 justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-github fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between w-100 ms-3 align-items-center">
                        <button class="btn btn-primary addLink" type="button">Add link</button>
                    </div>
                </div>
                @endif
                @if(session('user')->linkedin)
                <div class="d-flex align-items-center justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between justify-content-between w-100 ms-3 align-items-center">
                        <a href="{{session('user')->linkedin}}">{{session('user')->linkedin}}</a>
                        <button class="btn btn-primary btn-sm ms-2 changeLink">Change</button>
                    </div>
                </div>
                @else
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="iconDiv d-flex justify-content-center">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </div>
                        <div class="linkDiv d-flex justify-content-between w-100 ms-3 align-items-center">
                            <button class="btn btn-primary addLink" type="button">Add link</button>
                        </div>
                        {{-- <input type="text" id="linkedin" class="form-control border-0"/>--}}
                        {{--<button class="btn btn-primary" type="button">Save</button>--}}
                    </div>
                @endif
            </div>
            @endif
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                       @if(session('accountType') === 'company')
                        <div class="mb-3">
                            <label class="small mb-1" for="companyName">Company name</label>
                            <input class="form-control" id="companyName" type="text" disabled value="{{session('user')->name}}">
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputBio">Company description</label>
                            <textarea id="inputBio" cols="10" rows="10" disabled class="form-control">{{session('user')->description}}</textarea>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="website">Website</label>
                                <input class="form-control" id="website" name="website" type="text" disabled value="{{session('user')->website}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-companyName1" for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" type="text" disabled value="{{session('user')->phone}}">
                            </div>
                        </div>
                        @else
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="firstName">First name</label>
                                <input class="form-control" id="firstName" name="firstName" type="text" disabled value="{{session('user')->first_name}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-companyName1" for="lastName">Last name</label>
                                <input class="form-control" id="lastName" name="lastName" type="text" disabled value="{{session('user')->last_name}}">
                            </div>
                        </div>
                        @endif
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text" disabled value="{{session('user')->email}}">
                            </div>
                        </div>


                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Za usere "Applied jobs" , za kompanije "Posted jobs"-->
    @if(session()->has("user") && session("accountType") == "company")
        <h3 class="font-xl pt-5 mt-5">Posted jobs</h3>
    @else
        <h3 class="font-xl pt-5 mt-5">Applied jobs</h3>
    @endif
    @if(session()->has("user") && session("accountType") == "company")
        @foreach($company->jobs as $job)
            @if($job->status == \App\Models\Job::STATUS_ACTIVE)
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
                                <a class="btn btn-primary" href="{{route("jobs.show", $job->id)}}">View Job</a>
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
            @endif
        @endforeach

    @else
        @foreach($user->applications as $application)
            <div class="job-item p-4 mb-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{asset("assets/img/companies/" . $application->company->logo)}}" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h5 class="mb-3">{{$application->name}}</h5>
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$application->city->name}}</span>
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$application->full_time ? "Full time" : "Part-time"}}</span>
                            <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>{{$application->seniority->name}}</span>

                            @if($application->salary)
                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{$job->salary}}&euro;</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                        <div class="d-flex mb-3">
                                <a class="btn btn-light btn-square me-3" href=""><i class="far fa-heart text-primary"></i></a>
                            <a class="btn btn-muted" href="{{route("jobs.show", $application->id)}}">Applied</a>
                        </div>
                        <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{date('d/m/Y', strtotime($application->application_deadline))}}</small>
                    </div>
                    <div class="col-12">
                        <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                            @if($application->technology)
                                @foreach($application->technology as $technology)
                                    <span class="badge bg-primary me-2">{{$technology->name}}</span>
                                @endforeach
                                <span class="badge bg-primary me-2">{{$application->seniority->name}}</span>
                            @else
                                <span class="badge bg-primary me-2">{{$application->seniority->name}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Jobs End -->
        @endforeach
    @endif
</div>

@endsection
