@extends('layouts.layout')
@section('title') Login @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div class="container py-5">
        <div class="row d-flex flex-column align-items-center">
            <h2 class="text-center font-xl">Log in</h2>
            <div class="col-lg-5 col-md-7 col-12">
                <form id="loginForm" class="font-small mx-auto" method="POST" action="{{route("login.login")}}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control font-small" id="email" name="email" value="{{old('email')}}"/>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control font-small" id="password" name="password" />
                    </div>
                    <div class="mb-3 d-flex align-items-center">
                        <p class="my-0">Select your account type:</p>
                        <label for="employeeRadio" class="form-label mb-0 mx-2">Employee</label>
                        <input type="radio" class="form-control font-small" id="employeeRadio" value="employee" checked="checked" name="accountType" />
                        <label for="companyRadio" class="form-label mb-0 mx-2">Company</label>
                        <input type="radio" class="form-control font-small" id="companyRadio" value="company" name="accountType" />
                    </div>
                    <button id="btnLogin" class="btn btn-primary text-center d-block mx-auto px-4">
                        Log in
                    </button>
                    <br/>
                    <a href="{{route("register")}}" class="signInFormLink font-small">Don't have an account? Register instead.</a>
                </form>
                @if(session('error'))
                    <div class="container py-0 mt-5" >
                            <div class="alert alert-danger">
                                {{session('error')}}
                            </div>
                    </div>
                @endif
            </div>
        </div>


    </div>
@endsection
