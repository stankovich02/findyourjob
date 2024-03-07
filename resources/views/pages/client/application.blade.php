@extends('layouts.layout')
@section('title') Application @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div class="py-5 container">

        <div id="logo" class="text-center">
            <img src="{{asset('assets/img/users/' . $application->user->avatar)}}" alt="{{$application->user->first_name . " " . $application->user->last_name}}">
        </div>
        <h3 class="text-center font-xl pt-3 pd-0">{{$application->user->first_name . " " . $application->user->last_name}}</h3>
        <div class="text-center mb-3 d-flex justify-content-center mt-3">
            <span class="text-truncate me-3 fs-6 d-flex align-items-center"><i class="fa fa-envelope text-primary me-2 fs-4"></i>{{$application->user->email}}</span>
        </div>
        <div class="text-center mb-5 d-flex justify-content-center">
            @if($application->user->github)
                <span class="text-truncate me-3 d-flex align-items-center"><i class="fab fa-github text-primary me-2 fs-4"></i>
                    <a href="{{$application->user->github}}" class="fs-6">{{$application->user->github}}</a>
                </span>
            @endif
            @if($application->user->linkedin)
                <span class="text-truncate me-3 d-flex align-items-center"> <i class="fab fa-linkedin text-primary me-2 fs-4"></i>
                     <a href="{{$application->user->linkedin}}" class="fs-6">{{$application->user->linkedin}}</a>
                </span>
            @endif
        </div>
        <div class="text-center mb-5">
            <p class="mt-5 mb-1">Uploaded file:</p><a href="{{asset("assets/applications/" . $application->uploaded_file)}}" target="_blank" class="btn btn-primary mt-1">View document</a>
        </div>
        <h3 class="font-xl py-3">Cover Letter</h3>
        <p class="font-small">
            {{$application->cover_letter}}
        </p>
        <!-- Jobs End -->
    </div>
    @if(session()->get('accountType') == 'employee' && session()->get('user')->id == $application->user_id)
        <form action="{{route('application.destroy' , $application->id, $application->job->id)}}" method="post" class="d-flex justify-content-center">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline-danger mt-3" id="removeApplication">Remove Application</button>
        </form>
    @endif
    <div class="modal" tabindex="-1">
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
@endsection
@section('scripts')
    <script>
        $("#removeApplication").click(function (e) {
                e.preventDefault();
                $(".modal-body p").html(`Are you sure you want to delete your application?`);
                $(".modal").css("display", "block");
                $("#deleteModal").click(function (e) {
                    e.preventDefault();
                    $("form").submit();
                });
                $("#closeModal").click(function (e) {
                    e.preventDefault();
                    $(".modal").css("display", "none");
                });
            });
    </script>
@endsection
