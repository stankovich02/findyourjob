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
                    <img class="img-account-profile rounded-circle mb-2 img-fluid" src="{{asset('assets/img/users/' . $user->avatar)}}" alt="">
                    @else
                    <img class="img-account-profile rounded-circle mb-2 img-fluid" src="{{asset('assets/img/companies/' . $company->logo)}}" alt="">
                    @endif
                        <!-- Profile picture help block-->

                    <br/>
                    <!-- Profile picture upload button-->
                    <form action="{{route('account.picture')}}" method="POST" enctype="multipart/form-data" id="imageUpload" class="d-flex align-items-start flex-column">
                        @csrf
                        @method('PUT')
                        <input id="fileInput" type="file" class="mt-3" name="picture">
                        <button type="submit" class="btn btn-primary mt-3" id="uploadButton">Upload new picture</button>
                    </form>
                </div>
                @if($errors->has('picture'))
                <p id="pictureError" class="text-center text-danger">
                    {{$errors->first('picture')}}
                </p>
                @endif
                @if(session()->has('error'))
                    <p class="text-danger">{{session('error')}}</p>
                @endif
            </div>
            @if(session('accountType') === 'employee')
            <div id="profileLinks" class="mt-4">
                <h5 class="font-xl">Profile Links:</h5>
                @if($user->github)
                <div class="d-flex align-items-center mb-2 justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-github fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between justify-content-between w-100 ms-3 align-items-center">
                        <a href="{{$user->github}}">{{$user->github}}</a>
                        <button class="btn btn-primary ms-2 changeLink" data-social="github">Change</button>
                    </div>
                </div>
                @else
                <div class="d-flex align-items-center mb-2 justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-github fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between w-100 ms-3 align-items-center">
                        <button class="btn btn-primary addLink" type="button" data-social="github">Add link</button>
                    </div>
                </div>
                @endif
                @if($user->linkedin)
                <div class="d-flex align-items-center justify-content-start">
                    <div class="iconDiv d-flex justify-content-center">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </div>
                    <div class="linkDiv d-flex justify-content-between justify-content-between w-100 ms-3 align-items-center">
                        <a href="{{$user->linkedin}}">{{$user->linkedin}}</a>
                        <button class="btn btn-primary ms-2 changeLink" data-social="linkedin">Change</button>
                    </div>
                </div>
                @else
                    <div class="d-flex align-items-center justify-content-start">
                        <div class="iconDiv d-flex justify-content-center">
                            <i class="fab fa-linkedin fa-2x"></i>
                        </div>
                        <div class="linkDiv d-flex justify-content-between w-100 ms-3 align-items-center">
                            <button class="btn btn-primary addLink" type="button" data-social="linkedin">Add link</button>
                        </div>
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
                    @if(session('accountType') == "employee")
                        <form id="accountDetails" action="{{route("account.info")}}" method="POST">
                    @else
                        <form id="accountDetails" action="{{route("companies.update", session()->get("user")->id)}}" method="POST">
                    @endif
                        @csrf
                        @method('PUT')
                       @if(session('accountType') === 'company')
                        <div class="mb-3">
                            <label class="small mb-1" for="companyName">Company name</label>
                            <input class="form-control" name="companyName" id="companyName" type="text" disabled value="{{$company->name}}">
                            @if($errors->has('companyName'))
                                <p class="text-danger">
                                    {{$errors->first('companyName')}}
                                </p>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1" for="inputBio">Company description</label>
                            <textarea id="inputBio" name="description" cols="10" rows="10" disabled class="form-control">{{$company->description}}</textarea>
                            @if($errors->has('description'))
                                <p class="text-danger">
                                    {{$errors->first('description')}}
                                </p>
                            @endif
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="website">Website</label>
                                <input class="form-control" id="website" name="website" type="text" disabled value="{{$company->website}}">
                                @if($errors->has('website'))
                                    <p class="text-danger">
                                    {{$errors->first('website')}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-companyName1" for="phone">Phone</label>
                                <input class="form-control" id="phone" name="phone" type="text" disabled value="{{$company->phone}}">
                                @if($errors->has('phone'))
                                    <p class="text-danger">
                                    {{$errors->first('phone')}}
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text" disabled value="{{$company->email}}">
                                @if($errors->has('email'))
                                    <p class="text-danger">
                                    {{$errors->first('email')}}
                                    </p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Password</label>
                                <br/>
                                <a href="" class="btn btn-primary" id="btnChangePassword">Change password</a>
                            </div>
                        </div>
                        @else
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="firstName">First name</label>
                                <input class="form-control" id="firstName" name="firstName" type="text" disabled value="{{$user->first_name}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-companyName1" for="lastName">Last name</label>
                                <input class="form-control" id="lastName" name="lastName" type="text" disabled value="{{$user->last_name}}">
                            </div>
                        </div>
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="email">Email</label>
                                <input class="form-control" id="email" name="email" type="text" disabled value="{{$user->email}}">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1">Password</label>
                                <br/>
                                <a href="" class="btn btn-primary" id="btnChangePassword">Change password</a>
                            </div>
                        </div>
                        @endif
                       <div id="buttonsChange">
                           <button class="btn btn-primary" type="button" id="btnEdit">Edit</button>
                       </div>
                        </form>
                        </form>
                    @if(session()->has('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                    @if(session()->has('error'))
                        <p class="text-danger">{{session('error')}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Za usere "Applied jobs" , za kompanije "Posted jobs"-->
    @if(session()->has("user") && session("accountType") == "company")
        <h3 class="text-center pt-5 mt-5 mb-3">Posted jobs</h3>
    @else
        <h3 class="text-center pt-5 mt-5 mb-3">Applied jobs</h3>
    @endif
    @if(session()->has("user") && session("accountType") == "company")
        @if($company->jobs->count() == 0)
            <h4 class="text-center mt-5">You have not posted any jobs yet.</h4>
        @else
        @foreach($company->jobs as $job)
            @if($job->status == \App\Models\Job::STATUS_ACTIVE)
                <div class="job-item p-4 mb-4 position-relative">
                    @if($job->company_id == session()->get("user")->id)
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
                                <span class="text-truncate me-3"><i class="fas fa-briefcase text-primary me-2"></i>{{$job->workplace->name}}</span>
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
        @endif
    @else
        @if($user->applications->count() == 0)
            <h4 class="text-center mt-5">You have not applied for any jobs yet.</h4>
        @else
        @foreach($user->applications as $application)
            <div class="job-item p-4 mb-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                        <a href="{{route("companies.show", $application->company->id)}}"><img class="flex-shrink-0 img-fluid border rounded" src="{{asset("assets/img/companies/" . $application->company->logo)}}" alt="" style="width: 80px; height: 80px;"></a>
                        <div class="text-start ps-4">
                            <a href="{{route("jobs.show", $application->id)}}"><h5 class="mb-3 jobName">{{$application->name}}</h5></a>
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$application->city->name}}</span>
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$application->full_time ? "Full time" : "Part-time"}}</span>
                            <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>{{$application->seniority->name}}</span>
                            <span class="text-truncate me-3"><i class="fas fa-briefcase text-primary me-2"></i>{{$application->workplace->name}}</span>
                            @if($application->salary)
                                <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>{{$job->salary}}&euro;</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                        <div class="d-flex mb-3">
                            @if(session()->has("user") && session()->get("accountType") == "employee")
                                @if($application->saved_jobs->where("id", session()->get("user")->id)->first())
                                    <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$application->id}}" href=""><i class="fas fa-heart text-primary"></i></a>
                                @else
                                    <a class="btn btn-light btn-square me-3 saveJob" data-id="{{$application->id}}" href=""><i class="far fa-heart text-primary"></i></a>
                                @endif
                            @endif
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
        <h3 class="text-center pt-5 mt-5 mb-3">Saved jobs</h3>
        @if($user->saved_jobs->count() == 0)
            <h4 class="text-center mt-5">You have not saved any jobs yet.</h4>
        @else
            @foreach($user->saved_jobs as $job)
                <div class="job-item p-4 mb-4">
                    <div class="row g-4">
                        <div class="col-sm-12 col-md-8 d-flex align-items-center">
                            <a href="{{route("companies.show", $job->company->id)}}"><img class="flex-shrink-0 img-fluid border rounded" src="{{asset("assets/img/companies/" . $job->company->logo)}}" alt="" style="width: 80px; height: 80px;"></a>
                            <div class="text-start ps-4">
                                <a href="{{route("jobs.show", $job->id)}}"><h5 class="mb-3 jobName">{{$job->name}}</h5></a>
                                <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city->name}}</span>
                                <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$job->full_time ? "Full time" : "Part-time"}}</span>
                                <span class="text-truncate me-3"><i class="fa fa-user text-primary me-2"></i>{{$job->seniority->name}}</span>
                                <span class="text-truncate me-3"><i class="fas fa-briefcase text-primary me-2"></i>{{$job->workplace->name}}</span>
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
                            <small class="text-truncate"><i class="far fa-calendar-alt text-primary me-2"></i>Date Line: {{date('d/m/Y', strtotime($application->application_deadline))}}</small>
                        </div>
                        <div class="col-12">
                            <div class="mt-2 mt-lg-0 d-flex flex-wrap align-items-start gap-1">
                                @if($job->technology)
                                    @foreach($job->technology as $technology)
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
    @endif
</div>
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
@section('scripts')
    <script src="{{asset('assets/js/account.min.js')}}"></script>
@endsection
