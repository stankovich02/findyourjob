@extends('layouts.layout')
@section('title') Home @endsection
@section('description') Discover Your Dream Career or Ideal Talent with Find Your Job. Our platform connects top talent with leading employers, streamlining the job search process for candidates and facilitating efficient recruitment for businesses. Start your journey towards success today! @endsection
@section('keywords') home, jobs, career, talent, find your job @endsection
@section('content')
    <div class="container-fluid p-0 bg-primary" id="searchWrapper">
        <div class="container">
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
    </div>
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
    <div class="modal deleteJobModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="deleteModal" >Delete</button>
                </div>
            </div>
        </div>
    </div>
    <div class="boostJobModal modal " tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content py-4">
                <div class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    @if(session("boostSuccess"))
        <p id="boostSuccess">
            {{session("boostSuccess")}}
        </p>
    @endif
    @if(session("boostError"))
        <p id="boostError">
            {{session("boostError")}}
        </p>
    @endif
    @if(session('verified'))
        <p id="verifiedAccount" class="d-none">{{session('verified')}}</p>
    @endif
    @if(session('companyError'))
        <p id="companyError" class="d-none">{{session('companyError')}}</p>
    @endif
    @if(session('notVerified'))
        <p id="notVerified" class="d-none">{{session('notVerified')}}</p>
    @endif
@endsection
@section('scripts')
    <script src="{{asset("assets/js/home.js")}}"></script>
@endsection
