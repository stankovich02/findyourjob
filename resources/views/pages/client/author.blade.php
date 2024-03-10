@extends('layouts.layout')
@section('title') About Us @endsection
@section('description') Learn more about Find Your Job and our commitment to connecting top talent with leading employers. Discover our mission, values, and the innovative solutions we offer to streamline the job search process and facilitate efficient recruitment. Explore our story and see how we're transforming the way people find their dream careers and businesses discover exceptional talent. @endsection
@section('keywords') about, us, findyourjob, find, your, job, career, opportunities, talent, acquisition, mission, values, innovative, solutions, recruitment, story, dream, careers, businesses, exceptional, talent @endsection
@section('content')
<section id="author" class="my-5">
    <div class="container">
        <div class="row justify-content-center align-items-center flex-wrap">
            <div class="col-12 col-lg-6 text-center">
                <figure>
                    <img src="{{asset('assets/img/author.jpg')}}" alt="author img">
                </figure>
            </div>
            <div class="col-8 col-lg-6 text-center" id="about-author">
                <div id="about-text">
                    <h2>Marko Stanković 41/21</h2>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
