@extends('layouts.layout')
@section('title') Login @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
<div class="container py-5">
    <div class="row d-flex flex-column align-items-center">
        <div class="col-lg-5 col-md-7 col-12">
            <form id="loginForm" class="font-small mx-auto" method="POST" action="{{route("account.send_email_for_reset")}}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Enter account email:</label>
                <input type="text" class="form-control font-small" id="email" name="email" value="{{old('email')}}"/>
                @if($errors->has('email'))
                <p class="text-danger">{{$errors->first('email')}}</p>
                @endif

            </div>
            <button id="btnLogin" class="btn btn-primary text-center d-block mx-auto px-4">
                Send reset link
            </button>
            @if(session()->has('success'))
                <p class="text-success mt-3">{{session('success')}}</p>
            @endif
            <br/>
            @if(session()->has('error'))
            <p class="text-danger mt-3">{{session('error')}}</p>
            @endif
            <br/>
            </form>
        </div>
    </div>
</div>
<br/><br/><br/><br/><br/><br/>
@endsection

