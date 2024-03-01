@extends('layouts.layout')
@section('title') Register @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div class="container py-5" @if ($errors->any() || session("success")) style="opacity: 1!important;display:block!important;" @endif  id="regForm">
        <div class="row d-flex flex-column align-items-center">
        <h2 class="text-center font-xl">Register company</h2>
            <div class="col-lg-5 col-md-7 col-12">
        @if(session('success'))
            <div class="alert-success p-3">
                <p class="text-center m-0 font-medium">{{session('success')}}</p>
            </div>
        @endif
        <form enctype="multipart/form-data" id="registrationForm" name="registrationForm" class="font-small mx-auto" method="POST" action="{{route("companies.store")}}" >
            @csrf
            <div class="my-4">
                <label for="companyName" class="font-small">Company name</label>
                <input type="text" class="form-control font-small" id="companyName" name="companyName" value="{{old("companyName")}}"/>
                {{--<span class="font-small error-message">Jhon</span>--}}
            </div>
            <div class="my-4">
                <label for="website" class="font-small">Company website</label>
                <input type="text" class="form-control font-small" id="website" name="website" value="{{old("website")}}"/>
                {{--<span class="font-small error-message">Jhon</span>--}}
            </div>
            <div class="my-4">
                <label for="phone" class="font-small">Company phone</label>
                <input type="text" class="form-control font-small" id="phone" name="phone" value="{{old("phone")}}"/>
                {{--<span class="font-small error-message">Jhon</span>--}}
            </div>
            <div class="">
                <label for="Technologies" class="font-small">Company locations:</label>
                <div id="Technologies"></div>
            </div>
            <div id="Cities"></div>
            <div class="my-4">
                <label for="email" class="font-small">Email</label>
                <input type="text" class="form-control font-small" id="email" name="email" value="{{old("email")}}"/>
                {{--<span class="font-small error-message">name@example.com</span>--}}
            </div>
            <div class="my-4">
                <label for="password" class="font-small">Password</label>
                <input type="password" class="form-control font-small" id="password" name="password" value="{{old("password")}}"/>
                {{--  <span class="font-small error-message">Your password needs to be at least 8 characters long and contain at least one letter and one number</span>--}}
            </div>
            <div class="my-4">
                <label for="confirmPassword" class="font-small">Confirm password</label>
                <input type="password" class="form-control font-small" id="confirmPassword" name="confirmPassword" value="{{old("confirmPassword")}}"/>
                {{--<span class="font-small error-message">Your password needs to be at least 8 characters long and contain at least one letter and one number</span>--}}
            </div>
            <button id="btnRegister" class="btn btn-primary text-center d-block mx-auto px-4">
                Register
            </button>
            <br/>
            <a href="{{route("login")}}" class="signInFormLink" class="font-small">Already have an account? Log in instead.</a>
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
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        fetch('/api/cities')
            .then(response => response.json())
            .then(data => {
                let myOptions = data.map(city => {
                    return { label: city.name, value: city.id}
                });
                VirtualSelect.init({
                    ele: '#Cities',
                    options: myOptions,
                    multiple: true,
                    search: true,
                    maxWidth: '100%',
                });
            });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#btnRegister").click(function (e){
            e.preventDefault();
            $.ajax({
                url: "/companies",
                type: "POST",
                data: {
                    companyName: $("#companyName").val(),
                    website: $("#website").val(),
                    phone: $("#phone").val(),
                    cities: $("#Cities").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    confirmPassword: $("#confirmPassword").val(),
                },
                success: function (response) {
                    if(response.success){
                        $("#responseMessage").html("<p class='text-center text-success'>"+response.success+"</p>");
                    }
                },
                error: function (response){
                    if(response.responseJSON.errors){
                        let errors = response.responseJSON.errors;
                        let errorsHtml = "<ul>";
                        for (let key in errors){
                            errorsHtml += "<li>"+errors[key]+"</li>";
                        }
                        errorsHtml += "</ul>";
                        $("#responseMessage").html(errorsHtml);
                    }
                }
            });
        });
    </script>
@endsection
