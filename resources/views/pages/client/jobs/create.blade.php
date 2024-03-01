@extends('layouts.layout')
@section('title') Post a Job @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')
    <div class="container mx-auto bg-primary py-4 my-5 d-flex flex-column" id="postJobContainer">
        <h1 class="text-center text-white mb-5">Post a Job</h1>
        <form class="d-flex flex-column align-items-center" id="postJobForm" action="">
            @csrf
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobName" class="form-label text-white jobSearchLabel mb-2">Job name:</label>
                <input type="text" id="jobName" class="form-control border-0" name="jobName"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobCategory" class="form-label text-white jobSearchLabel mb-2">Job Category:</label>
                <select class="form-select border-0" id="jobCategory" name="jobCategory">
                    @foreach($array['categories'] as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSeniority" class="form-label text-white jobSearchLabel mb-2">Seniority:</label>
                <select class="form-select border-0" id="jobSeniority" name="jobSeniority">
                    @foreach($array['seniorities'] as $seniority)
                        <option value="{{$seniority->id}}">{{$seniority->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSalary" class="form-label text-white jobSearchLabel mb-2">Salary:</label>
                <input type="number" id="jobSalary" class="form-control border-0 postJobSalary" name="jobSalary"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobWorkType" class="form-label text-white jobSearchLabel">Work type:</label>
                <select class="form-select border-0" id="jobWorkType" name="jobWorkType">
                    <option value="0">Part Time</option>
                    <option value="1">Full Time</option>
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
                        <option value="{{$companyLocation->id}}">{{$companyLocation->name}}</option>
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
                <input type="date" id="jobAppDeadline" class="form-control border-0" name="jobAppDeadline"/>
            </div>

            <button type="submit" class="btn btn-dark mt-5 px-4 py-2" id="PostJob">POST JOB</button>
            <div id="responseMessage" class="mt-3"></div>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        fetch('http://127.0.0.1:8000/api/technologies')
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
                    maxWidth: '50%',
                });
            });
        var descriptionEditor, responsibilityEditor, requirementsEditor, benefitsEditor;

        ClassicEditor
            .create( document.querySelector( '#descriptionEditor' ) )
            .then( editor => {
                descriptionEditor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#responsibilityEditor' ) )
            .then( editor => {
                responsibilityEditor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#requirementsEditor' ) )
            .then( editor => {
                requirementsEditor = editor;
            } )
            .catch( error => {
                console.error( error );
            } );
        ClassicEditor
            .create( document.querySelector( '#benefitsEditor' ) )
            .then( editor => {
                benefitsEditor = editor;
            } )
            .catch( error => {
                    console.error( error );
                }
            );
        $("#PostJob").click(function (e) {
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/jobs',
                method: 'POST',
                data: data,
                success: function (data) {
                    $("#responseMessage").css('color', 'green');
                    $("#responseMessage").html(data);
                },
                error: function (data) {
                    $("#responseMessage").css('color', '#eb0202');
                    let html = "";
                    for (let key in data.responseJSON.errors) {
                        html += data.responseJSON.errors[key] + "<br>";
                    }
                    $("#responseMessage").html(html);
                }
            });
        });
    </script>
@endsection
