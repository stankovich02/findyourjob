@extends('layouts.layout')
@section('title') {{$job->name}} @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <!-- Job Detail Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <a href="{{route("jobs.index")}}" class="btn btn-primary mb-3">Back to jobs</a>
            @if(session()->has("user") && session("accountType") == "company" && $job->company->id == session()->get("user")->id)
                <br/>
                <a href="{{route("jobs.edit", $job->id)}}" class="btn btn-primary mb-3">Edit job</a>
            @endif
            <div class="row gy-5 gx-4">
                <div class="col-lg-8">
                    <div class="d-flex align-items-center mb-5">
                        <img class="flex-shrink-0 img-fluid border rounded" src="{{asset('assets/img/companies/' . $job->company->logo)}}" alt="" style="width: 80px; height: 80px;">
                        <div class="text-start ps-4">
                            <h3 class="mb-1">{{$job->name}}</h3>
                            <p class="m-0">{{$job->company->name}}</p>
                            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$job->city->name}}</span>
                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>{{$job->full_time ? "Full time" : "Part-time"}}</span>
                            @if($job->salary)
                                <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i>{{$job->salary}}&euro;</span>
                            @endif

                            <span class="text-truncate me-0"><i class="fa fa-user text-primary me-2"></i>{{$job->seniority->name}}</span>
                        </div>
                    </div>
                    <div class="mb-5">
                        <h4 class="mb-3" id="Description">Description:</h4>
                        <div class="jobDetails mb-3">
                            {!!($job->description)!!}
                        </div>

                        <h4 class="mb-3" id="Responsibility">Responsibilities:</h4>
                        <div class="jobDetails mb-3">
                            {!!$job->responsibilities!!}
                        </div>
                        <h4 class="mb-3" id="Qualifications">Requirements:</h4>
                        <div class="jobDetails mb-3">
                            {!!$job->requirements!!}
                        </div>
                        <h4 class="mb-3" id="Benefits">Benefits:</h4>
                        <div class="jobDetails mb-3">
                            {!!$job->benefits!!}
                        </div>
                    </div>
                    @if(session()->has("user") && session("accountType") == "employee")
                        @if($job->applications->where("user_id", session()->get("user")->id)->count() > 0)
                            <div class="col-3">
                                <?php $application = $job->applications->where("user_id", session()->get("user")->id)->first(); ?>
                                <a href="{{route("application.show", $application->id)}}" class="btn btn-primary w-100 py-2">View your application</a>
                            </div>
                        @else
                        <div class="">
                            <h4 class="mb-4">Apply For The Job</h4>
                            <div class="row g-3">
                                @if( session()->has("user") && session("accountType") == "employee")
                                    <form action="{{route("application.store")}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="jobID" value="{{$job->id}}">
                                        <div class="col-12 col-sm-6 mb-3">
                                            <input type="file" class="form-control bg-white" name="uploadedFile">
                                        </div>
                                        <div class="col-12 mb-3">
                                            <textarea class="form-control" rows="5" name="coverLetter" placeholder="Cover Letter"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100">Apply Now</button>
                                        </div>
                                    </form>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    @if (session("success"))
                                        <div class="alert alert-success">
                                            {{session("success")}}
                                        </div>
                                    @endif
                                @endif
                                {{-- <button class="btn btn-primary w-100" type="submit">Apply Now</button>--}}
                            </div>

                        </div>
                        @endif
                    @elseif(!session()->has("user"))
                    <div class="col-3">
                        <a href="{{route("login")}}" class="btn btn-primary w-100 py-2">Login to apply</a>
                    </div>
                    @endif

                </div>

                <div class="col-lg-4">
                    <div class="bg-light rounded p-5 mb-4 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Job Summary</h4>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Published On: {{date('d/m/Y', strtotime($job->created_at))}}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Job Nature: {{$job->full_time ? "Full time" : "Part-time"}}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Salary: {{$job->salary ? $job->salary . '€' : 'Not mentioned'}}</p>
                        <p><i class="fa fa-angle-right text-primary me-2"></i>Location: {{$job->city->name}}</p>
                        <p class="m-0"><i class="fa fa-angle-right text-primary me-2"></i>Application deadline: {{date('d/m/Y', strtotime($job->application_deadline))}}</p>
                    </div>
                    <div class="bg-light rounded p-5 wow slideInUp" data-wow-delay="0.1s">
                        <h4 class="mb-4">Company Detail</h4>
                        @if(strlen($job->company->description) > 300)
                            <p class="m-0">{{substr($job->company->description, 0, 300)}}... <a href="{{route("companies.show", $job->company->id)}}">Visit company <i class="fas fa-external-link-alt"></i></a> </p>
                        @else
                        <p class="m-0">{{$job->company->description}}</p>
                        @endif
                    </div>
                </div>
            </div>
            @if(session()->has("user") && session("accountType") == "company" && $job->company->id == session()->get("user")->id)
            <!-- Applied users -->
            <div class="row d-flex">
                <div class="col-12">
                    <h2 class="my-4 text-center">Applied Users</h2>
                </div>
                @if($job->applications->count() == 0)
                    <div class="col-12">
                        <p class="text-center">No users have applied for this job yet.</p>
                    </div>
                @else
                @endif
                @foreach($job->applications as $application)
                    <div class="col-6">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="{{asset('assets/img/users/' . $application->user->avatar)}}" alt="" style="width: 80px; height: 80px;">
                                    <h5 class="ms-3 mb-0">{{$application->user->first_name . " " . $application->user->last_name}}</h5>
                                </div>
                                <div class="col-sm-12 col-md-6 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <a class="btn btn-primary" href="{{route("application.show", $application->id)}}">View application</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    </div>
    <!-- Job Detail End -->
@endsection
