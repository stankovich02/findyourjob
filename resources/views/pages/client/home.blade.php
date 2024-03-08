@extends('layouts.layout')
@section('title') Home @endsection
@section('description') Discover Your Dream Career or Ideal Talent with Find Your Job. Our platform connects top talent with leading employers, streamlining the job search process for candidates and facilitating efficient recruitment for businesses. Start your journey towards success today! @endsection
@section('keywords') home, jobs, career, talent, find your job @endsection
@section('content')
    @if(session('verified'))
    <div id="verifiedAccount" class="d-flex align-items-center justify-content-center py-3">
        <p class="m-0 me-1 text-center">Your account has been successfully activated!</p>
        <img src="{{asset('assets/img/verified.png')}}" alt="Verified">
    </div>
    @endif
    @if(session('companyError'))
        <p id="companyError">{{session('companyError')}}</p>
    @endif
    <!-- Carousel Start -->
    <div class="container-fluid p-0 bg-primary py-5">
       {{-- <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="assets/img/carousel-1.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                     style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Uncover Your Dream Job: Your Deserved Opportunity Awaits</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Your perfect job is out there, waiting for you. Discover the opportunity you truly deserve and take the next step towards a fulfilling career.</p>
                                <a href="{{route('jobs.index')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A
                                    Job</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="assets/img/carousel-2.jpg" alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                     style="background: rgba(43, 57, 64, .5);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-10 col-lg-8">
                                <h1 class="display-3 text-white animated slideInDown mb-4">Elevate Your Career: Where Ambitions Meet Opportunities</h1>
                                <p class="fs-5 fw-medium text-white mb-4 pb-2">Elevate your career to new heights by seizing the opportunities you've been waiting for. Find your perfect match and soar towards success.</p>
                                <a href="{{route('jobs.index')}}" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Search A
                                    Job</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
            <div class="row pb-5">
                <div class="col-12">
                    <h2 class="text-center text-white p-0">Find your dream job with Find Your Job</h2>
                </div>
                <div class="col-6 mx-auto mt-4">
                    <div class="search-container mx-auto">
                        <input id="searchAll" type="text" placeholder="Search by job, company or technology..."/>
                        <img class="search-icon" src="https://cdn-icons-png.flaticon.com/512/483/483356.png" alt="Search">
                    </div>
                    <div id="searchResults" class="mx-auto">
                    </div>
                </div>
            </div>
    </div>
    <!-- Carousel End -->





    <!-- Category Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explore By Category</h1>
            <div class="row g-4">
                @foreach($data['categories'] as $c)
                <div class="col-lg-3 col-sm-6 wow fadeInUp categorySingle" data-id="{{$c->id}}" data-wow-delay="0.1s">

                    <a class="cat-item rounded p-4">
                        <img class="img-fluid mb-4" src="{{asset("assets/img/" . $c->icon)}}"/>
                     {{--   <i class="fa fa-3x fa-mail-bulk text-primary mb-4"></i>--}}
                        <h6 class="mb-3">{{$c->name}}</h6>
                        <p class="mb-0">{{$c->jobs->count()}} {{$c->jobs->count() == 1 ? "job" : "jobs"}}</p>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category End -->


    {{--<!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="row g-0 about-bg rounded overflow-hidden">
                        <div class="col-6 text-start">
                            <img class="img-fluid w-100" src="assets/img/about-1.jpg">
                        </div>
                        <div class="col-6 text-start">
                            <img class="img-fluid" src="assets/img/about-2.jpg" style="width: 85%; margin-top: 15%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid" src="assets/img/about-3.jpg" style="width: 85%;">
                        </div>
                        <div class="col-6 text-end">
                            <img class="img-fluid w-100" src="assets/img/about-4.jpg">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <h1 class="mb-4">We Help To Get The Best Job And Find A Talent</h1>
                    <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et
                        eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat
                        amet</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Tempor erat elitr rebum at clita</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Aliqu diam amet diam et eos</p>
                    <p><i class="fa fa-check text-primary me-3"></i>Clita duo justo magna dolore erat amet</p>
                    <a class="btn btn-primary py-3 px-5 mt-3" href="">Read More</a>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->
--}}

    <!-- Jobs Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Latest Jobs</h1>
            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade show p-0 active">
                        @if($data['jobs']->count() == 0)
                            <h4 class="text-center mt-5">There are no jobs available at the moment.</h4>
                        @else
                        @foreach($data['jobs'] as $job)
                           {{-- @include("pages.client.jobs.partials.job")--}}
                            <x-job :job="$job"/>
                        @endforeach
                        @endif
                        <a class="btn btn-primary py-3 px-5" href="{{route("jobs.index")}}">Browse More Jobs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Jobs End -->


   {{-- <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <h1 class="text-center mb-5">Our Clients Say!!!</h1>
            <div class="owl-carousel testimonial-carousel">
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore
                        diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="assets/img/testimonial-1.jpg"
                             style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore
                        diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="assets/img/testimonial-2.jpg"
                             style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore
                        diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="assets/img/testimonial-3.jpg"
                             style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item bg-light rounded p-4">
                    <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                    <p>Dolor et eos labore, stet justo sed est sed. Diam sed sed dolor stet amet eirmod eos labore
                        diam</p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="assets/img/testimonial-4.jpg"
                             style="width: 50px; height: 50px;">
                        <div class="ps-3">
                            <h5 class="mb-1">Client Name</h5>
                            <small>Profession</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->
--}}
@endsection
@section('scripts')
    <script src="{{asset("assets/js/home.js")}}"></script>
@endsection
