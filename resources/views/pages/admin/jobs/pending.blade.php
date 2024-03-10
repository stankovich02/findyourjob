@extends('layouts.admin-layout')
@section('title', 'Pending Jobs')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Main content -->
        <section class="content pt-3">
            @if(count($pendingJobs) == 0)
                <h3 class="text-center">No pending jobs.</h3>
            @else
                <table id="example2" class="table table-bordered table-hover pt-3">
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
            @endif
            @if(session('success'))
                <p class="text-success mt-5 d-none" id="successMessage">
                    {{session('success')}}
                </p>
            @endif
            @if(session('error'))
                <p class="text-danger mt-5 d-none" id="errorMessage">
                    {{session('error')}}
                </p>
            @endif
        </section>
        <!-- /.content -->
    </div>

@endsection

