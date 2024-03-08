@extends('layouts.layout')
@section('title') Companies @endsection
@section('description') Browse all companies. @endsection
@section('keywords') companies, findyourjob @endsection
@section('content')
    <div class="container">
        <h2 id="companiesHeading">Companies <span id="compCount">({{count($companies)}} results)</span></h2>
        <div id="allCompanies">
            <div class="row d-flex">
                @foreach($companies as $company)
                <div class="col-xl-3 col-lg-4 col-md-6 col-12">
                    <a href="{{route('companies.show', $company->id)}}" style="width: 18rem;">
                        <div class="card my-2 text-center py-5">
                            <img src="{{asset('assets/img/companies/'.$company->logo)}}" class="card-img-top mx-auto" alt="...">
                            <div class="card-body mt-4">
                                <h4 class="card-title">{{$company->name}}</h4>
                                <p class="card-text mt-5">{{count($company->jobs)}} {{count($company->jobs) == 1 ? "job" : "jobs"}}</p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>

        </div>
    </div>

@endsection
