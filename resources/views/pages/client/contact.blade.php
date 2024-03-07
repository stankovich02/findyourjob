@extends('layouts.layout')
@section('title') Contact Us @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <!-- Contact Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Contact For Any Query</h1>
            <div class="row g-4">
                <div class="col-12">
                    <div class="row gy-4">
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.1s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-map-marker-alt text-primary"></i>
                                </div>
                                <span>Knez Mihailova 11, Belgrade, Serbia</span>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.3s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-envelope-open text-primary"></i>
                                </div>
                                <span>findyourrjob@gmail.com</span>
                            </div>
                        </div>
                        <div class="col-md-4 wow fadeIn" data-wow-delay="0.5s">
                            <div class="d-flex align-items-center bg-light rounded p-4">
                                <div class="bg-white border rounded d-flex flex-shrink-0 align-items-center justify-content-center me-3" style="width: 45px; height: 45px;">
                                    <i class="fa fa-phone-alt text-primary"></i>
                                </div>
                                <span>+012 345 6789</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6 mx-auto">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        <form action="{{route("contact.store")}}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Your Name">
                                        <label for="name">Your Name</label>
                                    </div>
                                    @if($errors->has("name"))
                                        <p class="text-danger mt-2">{{$errors->first('name')}}</p>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Your Email">
                                        <label for="email">Your Email</label>
                                        @if($errors->has("email"))
                                            <p class="text-danger mt-2">{{$errors->first('email')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                        <label for="subject">Subject</label>
                                        @if($errors->has("subject"))
                                            <p class="text-danger mt-2">{{$errors->first('subject')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a message here" name="message" id="message" style="height: 150px"></textarea>
                                        <label for="message">Message</label>
                                        @if($errors->has("message"))
                                            <p class="text-danger mt-2">{{$errors->first('message')}}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit">Send Message</button>
                                </div>
                            </div>
                            @if(session("error"))
                                <p class="text-danger mt-3">{{session("error")}}</p>
                            @endif
                            @if(session("success"))
                                <p class="text-success mt-3">{{session("success")}}</p>
                            @endif

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
