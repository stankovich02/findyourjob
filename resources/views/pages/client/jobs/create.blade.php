@extends('layouts.layout')
@section('title') Post a Job @endsection
@section('description') Browse all of our products. @endsection
@section('keywords') shop, online, products @endsection
@section('content')

    <div class="container mx-auto bg-primary py-4 my-5 d-flex flex-column">
        <h1 class="text-center text-white mb-5">Post a Job</h1>
        <form class="d-flex flex-column align-items-center" id="postJobForm" action="#" method="GET">
            @csrf
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobName" class="form-label text-white jobSearchLabel mb-2">Job name:</label>
                <input type="text" id="jobName" class="form-control border-0" name="jobName"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobCategory" class="form-label text-white jobSearchLabel mb-2">Job Category:</label>
                <select class="form-select border-0" id="jobCategory" name="jobCategory">
                    <option value="1">Programming</option>
                    <option value="2">System administration</option>
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobSeniority" class="form-label text-white jobSearchLabel mb-2">Seniority:</label>
                <select class="form-select border-0" id="jobSeniority" name="jobSeniority">
                    <option value="1">Junior</option>
                    <option value="2">Medior</option>
                    <option value="3">Senior</option>
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="salary" class="form-label text-white jobSearchLabel mb-2">Salary:</label>
                <input type="number" id="salary" class="form-control border-0" name="jobSalary"/>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="workType" class="form-label text-white jobSearchLabel">Work type:</label>
                <select class="form-select border-0" id="workType" name="jobWorkType">
                    <option value="1">Full Time</option>
                    <option value="2">Part Time</option>
                </select>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="workPlace" class="form-label text-white jobSearchLabel">Workplace:</label>
                <select class="form-select border-0" id="workPlace" name="jobWorkplace">
                    <option value="0">Hybrid</option>
                    <option value="1">Office</option>
                    <option value="2">Remote</option>
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
                <label class="form-label text-white jobSearchLabel mb-2">Qualifications:</label>
                <div id="qualificationsEditor" contenteditable="true"></div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label class="form-label text-white jobSearchLabel mb-2">Benefits:</label>
                <div id="benefitsEditor" contenteditable="true"></div>
            </div>
           <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobTechnologies" class="form-label text-white jobSearchLabel mb-2">Job technologies:</label>
                <div id="technologies"></div>
            </div>
            <div class="col-md-10 d-flex flex-column align-items-center mb-3">
                <label for="jobAppDeadline" class="form-label text-white jobSearchLabel mb-2">Application deadline:</label>
                <input type="date" id="jobAppDeadline" class="form-control border-0" name="jobAppDeadline"/>
            </div>

            <button type="submit" class="btn btn-dark mt-5 px-4 py-2" id="postjob">POST JOB</button>
        </form>
    </div>
    <script src="{{asset('assets/js/virtual-select.min.js')}}"></script>
    <script>
        myOptions = [
            { label: 'Options 1', value: '1'},
            { label: 'Options 2', value: '2'},
            { label: 'Options 3', value: '3'}
        ];
        VirtualSelect.init({
            ele: '#technologies',
            options: myOptions,
            multiple: true,
            search: true,
            maxWidth: '50%',
        });
        var descriptionEditor, responsibilityEditor, qualificationsEditor, benefitsEditor;

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
            .create( document.querySelector( '#qualificationsEditor' ) )
            .then( editor => {
                qualificationsEditor = editor;
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
            } );

        document.getElementById('postjob').addEventListener('click', function(e){
            e.preventDefault();
            console.log(descriptionEditor.getData());


        });
    </script>
@endsection
