@extends('layouts.layout')
@section('title') Application @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div id="company-wrapper" class="w-75 py-5 mx-auto">
        <div id="logo" class="text-center">
            <img src="{{asset('assets/img/users/' . $application->user->avatar)}}" alt="{{$application->user->first_name . " " . $application->user->last_name}}">
        </div>
        <h3 class="text-center font-xl pt-3 pd-0">{{$application->user->first_name . " " . $application->user->last_name}}</h3>
        <div class="text-center mb-5">
            <br/>
            <span class="text-truncate me-3"><i class="fa fa-envelope text-primary me-2"></i>{{$application->user->email}}</span>
            <br/>
            <br/>
            @if($application->user->github)
                <span class="text-truncate me-3"><i class="fab fa-github text-primary me-2"></i>
                    <a href="{{$application->user->github}}">{{$application->user->github}}</a>
                </span>
            @endif
            @if($application->user->linkedin)
                <span class="text-truncate me-3"> <i class="fab fa-linkedin text-primary me-2"></i>
                     <a href="{{$application->user->linkedin}}">{{$application->user->linkedin}}</a>
                </span>
            @endif
            <p class="mt-5 mb-1">Uploaded file:</p><a href="{{asset("assets/applications/" . $application->uploaded_file)}}" target="_blank" class="btn btn-primary mt-1">View document</a>
        </div>
        <h3 class="font-xl py-3">Cover Letter</h3>
        <p class="font-small">
            {{$application->cover_letter}}
        </p>
        <!-- Jobs End -->
    </div>
@endsection
