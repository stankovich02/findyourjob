@extends('layouts.admin-layout')
@section('title', 'Jobs')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content pt-3">
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
            @if(session('success'))
                <p class="text-success mt-5 d-none" id="successMessage">
                    {{session('success')}}
                </p>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
