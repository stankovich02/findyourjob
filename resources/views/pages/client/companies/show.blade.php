@extends('layouts.layout')
@section('title') {{$company->name}} @endsection
@section('description') {{$company->description}} @endsection
@section('keywords') {{$company->name}}, jobs, company, location, category, technology, search @endsection
@section('content')
    <div id="company-wrapper" class="w-75 py-5 mx-auto">
        <div id="logo" class="text-center">
            <img src="{{asset('assets/img/companies/' . $company->logo)}}" alt="logo">
        </div>
        <h3 class="text-center font-xl pt-3 pd-0">{{$company->name}}</h3>
        <div class="text-center mb-5">
            <span class="text-truncate me-3"><i class="fa fa-map-marker-alt text-primary me-2"></i>
            @foreach($company->cities as $city)
                {{$city->name}}
                @if(!$loop->last)
                    ,
                @endif
            @endforeach
            </span>
            <span class="text-truncate me-3"><i class="fa fa-envelope text-primary me-2"></i>{{$company->email}}</span>
            <span class="text-truncate me-3"><i class="fa fa-phone text-primary me-2"></i>{{$company->phone}}</span>
        </div>
        <h3 class="font-xl py-3">About {{$company->name}}</h3>
        <p class="font-small">{{$company->description}}</p>
        <h3 class="font-xl pt-5 mb-5">Jobs</h3>
        @if(count($company->jobs) == 0)
            <h4 class="text-center mt-5">There are no jobs available at the moment.</h4>
        @else
        @foreach($company->jobs as $job)
          <x-job :job="$job" />
        @endforeach
        @endif
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".saveJob").click(function (e) {
            e.preventDefault();
            let id = $(this).attr('data-id');
            let icon = this.querySelector('i');
            $.ajax({
                url: '/jobs/save/' + id,
                method: 'POST',
                data: {
                    jobID: id
                },
                success: function (data) {
                    /*showModal(data);*/

                    if(icon.className === "far fa-heart text-primary")
                        setTimeout(() => {
                            icon.className = "fas fa-heart text-primary";
                        }, 1000);
                    else
                        setTimeout(() => {
                            icon.className = "far fa-heart text-primary";
                        }, 1000);
                    if(window.location.pathname === "/account"){
                        location.reload();
                    }

                },
                error: function (data) {
                    let html = "";
                    for (let key in data.responseJSON.errors) {
                        html += data.responseJSON.errors[key] + "<br>";
                    }
                    showModal(html);

                }
            });
        });
    </script>
@endsection
