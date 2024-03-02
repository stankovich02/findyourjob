@extends('layouts.layout')
@section('title') Edit a Job @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div class="container mx-auto bg-primary py-4 my-5 d-flex flex-column" id="postJobContainer">
        <h1 class="text-center text-white mb-5">Edit a Job</h1>
        <form class="d-flex flex-column align-items-center" id="postJobForm" action="">
            @csrf
            <input type="hidden" id="jobID" value="{{$array['job']->id}}"/>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobName" class="form-label text-white jobSearchLabel mb-2">Job name:</label>
                <input type="text" id="jobName" class="form-control border-0" name="jobName" value="{{$array['job']->name}}"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobCategory" class="form-label text-white jobSearchLabel mb-2">Job Category:</label>
                <select class="form-select border-0" id="jobCategory" name="jobCategory">
                    @foreach($array['categories'] as $category)
                        @if($array['job']->category_id === $category->id)
                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                        @else
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSeniority" class="form-label text-white jobSearchLabel mb-2">Seniority:</label>
                <select class="form-select border-0" id="jobSeniority" name="jobSeniority">
                    @foreach($array['seniorities'] as $seniority)
                        @if($array['job']->seniority_id === $seniority->id)
                            <option value="{{$seniority->id}}" selected>{{$seniority->name}}</option>
                        @else
                        <option value="{{$seniority->id}}">{{$seniority->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSalary" class="form-label text-white jobSearchLabel mb-2">Salary:</label>
                <input type="number" id="jobSalary" class="form-control border-0 postJobSalary" name="jobSalary" value="{{$array['job']->salary}}"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobWorkType" class="form-label text-white jobSearchLabel">Work type:</label>
                <select class="form-select border-0" id="jobWorkType" name="jobWorkType">
                    <option value="0" @if(!$array['job']->full_time) {{"selected"}} @endif>Part Time</option>
                    <option value="1" @if($array['job']->full_time) {{"selected"}} @endif>Full Time</option>
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobWorkPlace" class="form-label text-white jobSearchLabel">Workplace:</label>
                <select class="form-select border-0" id="jobWorkPlace" name="jobWorkPlace">
                    @foreach($array['workplaces'] as $workplace)
                        <option value="{{$workplace->id}}">{{$workplace->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobLocation" class="form-label text-white jobSearchLabel">Location:</label>
                <select class="form-select border-0" id="jobLocation" name="jobLocation">
                    @foreach($array['companyLocations']->cities as $companyLocation)
                        @if($array['job']->city_id === $companyLocation->id)
                            <option value="{{$companyLocation->id}}" selected>{{$companyLocation->name}}</option>
                        @else
                        <option value="{{$companyLocation->id}}">{{$companyLocation->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Description:</label>
                <div id="descriptionEditor">
                </div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Responsibility:</label>
                <div id="responsibilityEditor" contenteditable="true"></div>
            </div>

            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Requirements:</label>
                <div id="requirementsEditor" contenteditable="true"></div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Benefits:</label>
                <div id="benefitsEditor" contenteditable="true"></div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobTechnologies" class="form-label text-white jobSearchLabel mb-2">Job technologies:</label>
                <div id="Technologies"></div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobAppDeadline" class="form-label text-white jobSearchLabel mb-2">Application deadline:</label>
                <input type="date" id="jobAppDeadline" class="form-control border-0" name="jobAppDeadline" value="{{date($array['job']->application_deadline)}}"/>
            </div>

            <button type="submit" class="btn btn-dark mt-5 px-4 py-2" id="EditJob">EDIT JOB</button>
            <div id="responseMessage" class="mt-3"></div>
        </form>
    </div>
    @php
        $newArray = [];
        foreach($array['job']->technology as $technology){
            array_push($newArray, $technology->id);
        }
        $newArray = json_encode($array);
    @endphp

@endsection
@section('scripts')
    <script src="{{asset('assets/js/virtual-select.min.js')}}"></script>
    <script>
        fetch('/api/technologies')
            .then(response => response.json())
            .then(data => {
                let myOptions = data.map(technology => {
                    return { label: technology.name, value: technology.id}
                });
                VirtualSelect.init({
                    ele: '#Technologies',
                    options: myOptions,
                    multiple: true,
                    search: true,
                    selectedValue: {{json_encode($array['job']->technology->pluck('id')->toArray())}},
                    maxWidth: '50%',
                });
            });
        var descriptionEditor, responsibilityEditor, requirementsEditor, benefitsEditor;

        ClassicEditor
            .create( document.querySelector( '#descriptionEditor' ) )
            .then( editor => {
                descriptionEditor = editor;
                descriptionEditor.setData(`{!!$array['job']->description!!}`);
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#responsibilityEditor' ) )
            .then( editor => {
                responsibilityEditor = editor;
                responsibilityEditor.setData(`{!!$array['job']->responsibilities!!}`);
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#requirementsEditor' ) )
            .then( editor => {
                requirementsEditor = editor;
                requirementsEditor.setData(`{!!$array['job']->requirements!!}`);
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#benefitsEditor' ) )
            .then( editor => {
                benefitsEditor = editor;
                benefitsEditor.setData(`{!!$array['job']->benefits!!}`);
            } )
            .catch( error => {
                    console.error( error );
                }
            );
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $("#EditJob").click(function (e) {
            e.preventDefault();
            let name = $("#jobName").val();
            let category = $("#jobCategory").val();
            let seniority = $("#jobSeniority").val();
            let location = $("#jobLocation").val();
            let salary = $("#jobSalary").val();
            let workType = $("#jobWorkType").val();
            let workplace = $("#jobWorkPlace").val();
            let description = descriptionEditor.getData();
            let responsibilities = responsibilityEditor.getData();
            let requirements = requirementsEditor.getData();
            let benefits = benefitsEditor.getData();
            let technologies = $("#Technologies").val();
            let applicationDeadline = $("#jobAppDeadline").val();
            let data = {
                name: name,
                category: category,
                seniority: seniority,
                location: location,
                salary: salary,
                workType: workType,
                workplace: workplace,
                description: description,
                responsibilities: responsibilities,
                requirements: requirements,
                benefits: benefits,
                technologies: technologies,
                applicationDeadline: applicationDeadline
            };
            $.ajax({
                url: '/jobs/' + $("#jobID").val(),
                method: 'PUT',
                data: data,
                success: function (data) {
                    //toastr data.message
                },
                error: function (data) {
                   //toastr data.error
                }
            });
        });
    </script>
@endsection

