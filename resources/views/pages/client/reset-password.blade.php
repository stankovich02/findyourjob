@extends('layouts.layout')
@section('title') Reset password @endsection
@section('description') Reset your password @endsection
@section('keywords') reset, password, user @endsection
@section('content')
    <div class="container py-5">
        <div class="row d-flex flex-column align-items-center">
            <div class="col-lg-5 col-md-7 col-12">
                <form id="loginForm" class="font-small mx-auto" method="POST" action="{{route("account.reset_password", $token)}}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="passwordLogin" class="form-label">New password:</label>
                        <div id="passwordDiv">
                            <input type="password" class="form-control font-small" id="passwordLogin" name="password" />
                            <i toggle="#passwordLogin" class="toggle-password fas fa-eye"></i>
                            @if($errors->has('password'))
                                <p class="text-danger mt-3">{{$errors->first('password')}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="resetPasswordLogin" class="form-label">Confirm new password:</label>
                        <div id="passwordDiv">
                            <input type="password" class="form-control font-small" id="resetPasswordLogin" name="confirmPassword" />
                            <i toggle="#resetPasswordLogin" class="toggle-password fas fa-eye"></i>
                            @if($errors->has('confirmPassword'))
                                <p class="text-danger mt-3">{{$errors->first('confirmPassword')}}</p>
                            @endif
                        </div>
                    </div>
                    <button id="btnLogin" class="btn btn-primary text-center d-block mx-auto px-4">
                        Reset password
                    </button>
                    <br/>
                    @if(session()->has('error'))
                        <p class="text-danger">{{session('error')}}</p>
                    @endif
                    <br/>
                </form>
            </div>
        </div>
    </div>
    <br/><br/><br/><br/><br/><br/>
@endsection


