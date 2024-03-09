@extends('layouts.layout')
@section('title') Account @endsection
@section('description') Account details page @endsection
@section('keywords') account, user, company , password, linkedin, github , saved jobs @endsection
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
                        <form action="{{session('accountType') == 'employee' ? route('account.picture') : route('companies.logo', session()->get("user")->id)}}" method="POST" enctype="multipart/form-data" id="imageUpload" class="d-flex align-items-start flex-column">
                            @csrf
                            @method('PATCH')
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
            @if(session("accountType") == "employee")
            <div id="progressDetailsBar" class="mb-2">
                <div class="progress">
                    @php
                        $progress = 0;
                        if($user->linkedin){
                            $progress += 35;
                        }
                        if($user->github){
                            $progress += 35;
                        }
                        if($user->avatar !== "user.jpg"){
                            $progress += 30;
                        }
                    @endphp
                    <div class="progress-bar" role="progressbar" style="width: {{$progress}}%" aria-valuenow="{{$progress}}" aria-valuemin="0" aria-valuemax="100">{{$progress}}%</div>
                </div>
                @if($progress < 100)
                    <p class="text-center mt-2">Complete your profile to increase your chances of getting hired.</p>
                    <p class="my-0 mt-3">LinkedIn link
                    @if($duser->linkedin)
                        <i class="fas fa-check-circle"></i>
                    @endif</p>
                    <p class="my-0">Github link
                    @if($user->github)
                        <i class="fas fa-check-circle"></i>
                    @endif
                    </p>
                    <p class="my-0">Profile picture
                        @if($user->avatar !== "user.jpg")
                            <i class="fas fa-check-circle"></i>
                        @endif
                    </p>
                @else
                    <p class="text-center mt-2">Your profile is complete. You are now more likely to get hired. <i class="far fa-laugh-wink"></i> </p>
                @endif
            </div>
            @endif
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    @if(session('accountType') == "employee")
                        <form id="accountDetails" action="{{route("account.info")}}" method="POST">
                    @else
                        <form id="accountDetails" action="{{route("companies.update", session()->get("user")->id)}}" method="POST">
                    @endif
                        @csrf
                        @method('PATCH')
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
                                <a href="{{route('account.show_form_for_new_password')}}" class="btn btn-primary" id="btnChangePassword">Change password</a>
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
                                <a href="{{route('account.show_form_for_new_password')}}" class="btn btn-primary" id="btnChangePassword">Change password</a>
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
                    <x-job :job="$job"/>
            @endif
        @endforeach
        @endif
    @else
        @if($user->applications->count() == 0)
            <h4 class="text-center mt-5">You have not applied for any jobs yet.</h4>
        @else
            @foreach($user->applications as $application)
                    <x-job :job="$application"/>
            @endforeach
        @endif
        <h3 class="text-center pt-5 mt-5 mb-3">Saved jobs</h3>
        @if($user->saved_jobs->count() == 0)
            <h4 class="text-center mt-5">You have not saved any jobs yet.</h4>
        @else
            @foreach($user->saved_jobs as $job)
                    <x-job :job="$job"/>
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
<div class="boostJobModal modal " tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content py-4">
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" id="closeModal" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@if(session("boostSuccess"))
    <p id="boostSuccess">
        {{session("boostSuccess")}}
    </p>
@endif
@if(session("boostError"))
    <p id="boostError">
        {{session("boostError")}}
    </p>
@endif
@endsection
@section('scripts')
    <script src="{{asset('assets/js/account.js')}}"></script>
@endsection
