@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
            <div class="card card-primary card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#allJobs" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#pendingJobs" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Pending Jobs</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade active show" id="allJobs" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Company</th>
                                    <th>Location</th>
                                    <th>Category</th>
                                    <th>Salary</th>
                                    <th>Work type</th>
                                    <th>Seniority</th>
                                    <th>Workplace</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($jobs as $job)
                                    <tr>
                                        <td>{{ $job->id }}</td>
                                        <td>{{ $job->name }}</td>
                                        <td>{{ $job->company->name }}</td>
                                        <td>{{ $job->city->name }}</td>
                                        <td>{{ $job->category->name }}</td>
                                        @if($job->salary == 0)
                                            <td>Not mentioned</td>
                                        @else
                                            <td>{{ $job->salary }}&euro;</td>
                                        @endif
                                        <td>{{$job->full_time ? "Full Time" : "Part Time"}}</td>
                                        <td>{{$job->seniority->name}}</td>
                                        <td>{{$job->workplace->name}}</td>


                                        <td>
                                            <a href="{{route('admin.jobs.show', $job->id)}}" class="btn btn-primary">
                                                <i class="fas fa-eye me-2"></i>  View more...</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $jobs->links()}}
                        </div>
                        <div class="tab-pane fade" id="pendingJobs" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                            @if(count($pendingJobs) == 0)
                                <h3 class="text-center">No pending jobs.</h3>
                            @else
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Company</th>
                                        <th>Location</th>
                                        <th>Category</th>
                                        <th>Salary</th>
                                        <th>Work type</th>
                                        <th>Seniority</th>
                                        <th>Workplace</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($pendingJobs as $job)
                                        <tr>
                                            <td>{{ $job->id }}</td>
                                            <td>{{ $job->name }}</td>
                                            <td>{{ $job->company->name }}</td>
                                            <td>{{ $job->city->name }}</td>
                                            <td>{{ $job->category->name }}</td>
                                            @if($job->salary == 0)
                                                <td>Not mentioned</td>
                                            @else
                                                <td>{{ $job->salary }}&euro;</td>
                                            @endif
                                            <td>{{$job->full_time ? "Full Time" : "Part Time"}}</td>
                                            <td>{{$job->seniority->name}}</td>
                                            <td>{{$job->workplace->name}}</td>


                                            <td>
                                                <a href="{{route('admin.jobs.show', $job->id)}}" class="btn btn-primary">
                                                    <i class="fas fa-eye me-2"></i>  View more...</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            {{ $jobs->links()}}
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            @if(session('success'))
                <p class="text-success mt-5 d-none" id="successMessage">
                    {{session('success')}}
                </p>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
