@extends('layouts.layout')
@section('title') About Us @endsection
@section('description') Learn more about Find Your Job and our commitment to connecting top talent with leading employers. Discover our mission, values, and the innovative solutions we offer to streamline the job search process and facilitate efficient recruitment. Explore our story and see how we're transforming the way people find their dream careers and businesses discover exceptional talent. @endsection
@section('keywords') about, us, findyourjob, find, your, job, career, opportunities, talent, acquisition, mission, values, innovative, solutions, recruitment, story, dream, careers, businesses, exceptional, talent @endsection
@section('content')
    <div class="container-xxl py-5 bg-dark page-header mb-5">
        <div class="container my-5 pt-5 pb-4">
            <h1 class="display-3 text-white mb-3 animated slideInDown">About Us</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="{{asset('assets/img/about-1.jpg')}}" alt="about-1">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="{{asset('assets/img/about-2.jpg')}}" style="width: 85%; margin-top: 15%;" alt="about-2">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="{{asset('assets/img/about-3.jpg')}}" style="width: 85%;" alt="about-3">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="{{asset('assets/img/about-4.jpg')}}"alt="about-4">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">We Help To Get The Best Job And Find A Talent</h1>
                    <p class="mb-4">At Find Your Job, we are dedicated to facilitating connections between top talent and leading employers. Our platform streamlines the job search process, ensuring candidates find the perfect fit while employers discover exceptional talent effortlessly.</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Tailored Job Matching</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Comprehensive Talent Pool</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Efficient Recruitment Tools</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
@endsection
