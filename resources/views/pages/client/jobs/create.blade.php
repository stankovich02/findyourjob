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
                <label for="jobName" class="form-label text-white jobSearchLabel">Job name:</label>
                <input type="text" id="jobName" class="form-control border-0" name="jobName"/>
                <p id="nameError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobCategory" class="form-label text-white jobSearchLabel">Job Category:</label>
                <select class="form-select border-0" id="jobCategory" name="jobCategory">
                    @foreach($array['categories'] as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
                <p id="categoryError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSeniority" class="form-label text-white jobSearchLabel">Seniority:</label>
                <select class="form-select border-0" id="jobSeniority" name="jobSeniority">
                    @foreach($array['seniorities'] as $seniority)
                        <option value="{{$seniority->id}}">{{$seniority->name}}</option>
                    @endforeach
                </select>
                <p id="seniorityError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSalary" class="form-label text-white jobSearchLabel">Salary:</label>
                <input type="number" id="jobSalary" class="form-control border-0 postJobSalary" name="jobSalary"/>
                <p id="salaryError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobWorkType" class="form-label text-white jobSearchLabel">Work type:</label>
                <select class="form-select border-0" id="jobWorkType" name="jobWorkType">
                    <option value="0">Part Time</option>
                    <option value="1">Full Time</option>
                </select>
                <p id="workTypeError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobWorkPlace" class="form-label text-white jobSearchLabel">Workplace:</label>
                <select class="form-select border-0" id="jobWorkPlace" name="jobWorkPlace">
                    @foreach($array['workplaces'] as $workplace)
                        <option value="{{$workplace->id}}">{{$workplace->name}}</option>
                    @endforeach
                </select>
                <p id="workplaceError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobLocation" class="form-label text-white jobSearchLabel">Location:</label>
                <select class="form-select border-0" id="jobLocation" name="jobLocation">
                    @foreach($array['companyLocations']->cities as $companyLocation)
                        <option value="{{$companyLocation->id}}">{{$companyLocation->name}}</option>
                    @endforeach
                </select>
                <p id="locationError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Description:</label>
              <div id="descriptionEditor"></div>
                <p id="descriptionError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel">Responsibility:</label>
                <div id="responsibilityEditor" contenteditable="true"></div>
                <p id="responsibilitiesError" class="text-danger"></p>
            </div>

            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel">Requirements:</label>
                <div id="requirementsEditor" contenteditable="true"></div>
                <p id="requirementsError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel">Benefits:</label>
                <div id="benefitsEditor" contenteditable="true"></div>
                <p id="benefitsError" class="text-danger"></p>
            </div>
           <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobTechnologies" class="form-label text-white jobSearchLabel">Job technologies:</label>
                <div id="Technologies"></div>
               <p id="technologiesError" class="text-danger"></p>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobAppDeadline" class="form-label text-white jobSearchLabel">Application deadline:</label>
                <input type="date" id="jobAppDeadline" class="form-control border-0" name="jobAppDeadline"/>
                <p id="applicationDeadlineError" class="text-danger"></p>
            </div>

            <button type="submit" class="btn btn-dark mt-5 px-4 py-2" id="PostJob">POST JOB</button>
        </form>
    </div>
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
            let fieldsIds = ['jobName', 'jobCategory', 'jobSeniority', 'jobLocation', 'jobSalary', 'jobWorkType', 'jobWorkPlace', 'jobAppDeadline'];
            $.ajax({
                url: '/jobs',
                method: 'POST',
                data: data,
                success: function (data) {
                    $("form p").text("");
                   toastr.success(data.message);
                },
                error: function (data) {
                    $("form p").text("");
                    if(data.responseJSON.errors){
                        for (let key in data.responseJSON.errors) {
                            $("#" + key + "Error").text(data.responseJSON.errors[key][0]);
                        }
                    }
                    if(data.responseJSON.error){
                        toastr.error(data.responseJSON.error);
                    }
                }
            });
        });
    </script>
@endsection
