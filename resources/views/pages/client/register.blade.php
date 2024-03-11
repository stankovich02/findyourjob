@extends('layouts.layout')
@section('title') Register @endsection
@section('description') Register to our website @endsection
@section('keywords') register, user, company @endsection
@section('content')
    @if ((!session("success") && !$errors->any()))
    <div id="registerBegin" class="d-flex flex-column align-items-center my-5 py-5 container">
        <h1>Are You a?</h1>
        <div id="chooseAccountType" class="d-flex my-5 justify-content-around w-50">
            <div class="accountType text-center text-white py-4 px-5" id="employeeButton">
                <div class="accountTypeImage mb-3">
                    <img src="{{asset('assets/img/office-worker.png')}}" alt="Employee">
                </div>
                <div class="accountTypeText" >
                    <h3 class="text-white">Employee</h3>
                    <p>Find a job that suits you</p>
                </div>
            </div>
            <div class="accountType text-center text-white py-4 px-5" id="companyButton">
                <div class="accountTypeImage mb-3">
                    <img src="{{asset('assets/img/company.png')}}" alt="Company">
                </div>
                <div class="accountTypeText" >
                    <h3 class="text-white">Company</h3>
                    <p>Find the best employees</p>
                </div>
            </div>
        </div>
    </div>
    @endif
        <div class="container py-5" @if ($errors->any() || session("success")) style="opacity: 1!important;display:block!important;" @endif  id="regFormUser">
            <div class="row d-flex flex-column align-items-center">
        <h2 class="text-center font-xl">Register user</h2>
                <div class="col-lg-5 col-md-7 col-12">
        <form id="registrationForm" name="registrationForm" class="font-small mx-auto" method="POST" action="{{route("register.register")}}">
            @csrf
            <div class="my-4">
                <label for="firstname" class="font-small">First name</label>
                <input type="text" class="form-control font-small" id="firstname" name="firstName" value="{{old("firstName")}}"/>
                @if($errors->has("firstName"))
                    <p class="text-danger mt-1">{{$errors->first("firstName")}}</p>
                @endif
            </div>
            <div class="my-4">
                <label for="lastname" class="font-small">Last name</label>
                <input type="text" class="form-control font-small" id="lastname" name="lastName" value="{{old("lastName")}}"/>
                @if($errors->has("lastName"))
                    <p class="text-danger mt-1">{{$errors->first("lastName")}}</p>
                @endif
            </div>
            <div class="my-4">
                <label for="email" class="font-small">Email</label>
                <input type="text" class="form-control font-small" id="email" name="email" value="{{old("email")}}"/>
                @if($errors->has("email"))
                    <p class="text-danger mt-1">{{$errors->first("email")}}</p>
                @endif
            </div>
            <div class="mb-3">
                <label for="passwordLogin" class="form-label">Password</label>
                <div id="passwordDiv">
                    <input type="password" class="form-control font-small" id="password" name="password" value="{{old("password")}}"/>
                    <i toggle="#password" class="toggle-password fas fa-eye"></i>
                    @if($errors->has("password"))
                        <p class="text-danger mt-1">{{$errors->first("password")}}</p>
                    @endif
                </div>
            </div>
            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Password</label>
                <div id="passwordDiv">
                    <input type="password" class="form-control font-small" id="confirmPassword" name="confirmPassword" value="{{old("password")}}"/>
                    <i toggle="#confirmPassword" class="toggle-password fas fa-eye"></i>
                    @if($errors->has("confirmPassword"))
                        <p class="text-danger mt-1">{{$errors->first("confirmPassword")}}</p>
                    @endif
                </div>
            </div>
            <button id="btnRegister" class="btn btn-primary text-center d-block mx-auto px-4">
                Register
            </button>
            <br/>
            <a href="{{route("login")}}" class="signInFormLink font-small">Already have an account? Log in instead.</a>
        </form>
                </div>
            </div>
    </div>
    @if(session("success"))
        <div class="container w-50 py-0 mt-3">
            @if(session('success'))
                <div class="alert-success p-3">
                    <p class="text-center m-0 font-medium">{{session('success')}}</p>
                </div>
            @endif
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{asset('assets/js/register.min.js')}}"></script>
@endsection
