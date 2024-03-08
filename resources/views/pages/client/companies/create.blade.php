@extends('layouts.layout')
@section('title') Register @endsection
@section('description') Register company @endsection
@section('keywords') register, company, user @endsection
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
                <p id="companyNameError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="website" class="font-small">Company website</label>
                <input type="text" class="form-control font-small" id="website" name="website" value="{{old("website")}}"/>
                <p id="websiteError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="phone" class="font-small">Company phone</label>
                <input type="text" class="form-control font-small" id="phone" name="phone" value="{{old("phone")}}"/>
                <p id="phoneError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="Cities" class="font-small">Company locations:</label>
                <div id="Cities"></div>
                <p id="citiesError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="description">Description:</label>
                <textarea class="form-control" name="description" id="description" style="height: 150px"></textarea>
                <p id="descriptionError" class="text-danger">
            </div>

            <div class="my-4">
                <label for="email" class="font-small">Email</label>
                <input type="text" class="form-control font-small" id="email" name="email" value="{{old("email")}}"/>
                <p id="emailError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="password" class="font-small">Password</label>
                <input type="password" class="form-control font-small" id="password" name="password" value="{{old("password")}}"/>
                <p id="passwordError" class="text-danger">
            </div>
            <div class="my-4">
                <label for="confirmPassword" class="font-small">Confirm password</label>
                <input type="password" class="form-control font-small" id="confirmPassword" name="confirmPassword" value="{{old("confirmPassword")}}"/>
                <p id="confirmPasswordError" class="text-danger">
            </div>
            <button id="btnRegister" class="btn btn-primary text-center d-block mx-auto px-4">
                Register
            </button>
            <br/>
            <a href="{{route("login")}}" class="signInFormLink" class="font-small">Already have an account? Log in instead.</a>
        </form>
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
                    description: $("#description").val(),
                    email: $("#email").val(),
                    password: $("#password").val(),
                    confirmPassword: $("#confirmPassword").val(),
                },
                success: function (data) {
                    $("form p").text("");
                    $("form input").val("");
                    $("form textarea").val("");
                    document.querySelector('#Cities').reset();
                    toastr.success(data.message);
                },
                error: function (data){
                    $("form p").text("");
                    if(data.responseJSON.errors){
                        for (let key in data.responseJSON.errors) {
                            $("#" + key + "Error").text(data.responseJSON.errors[key][0]);
                        }
                    }
                    if(data.responseJSON.error){
                        toastr.error(data.responseJSON.error);
                    }
                }
            });
        });
    </script>
@endsection
