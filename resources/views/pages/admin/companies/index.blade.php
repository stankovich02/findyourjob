@extends('layouts.admin-layout')
@section('title', 'Companies')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <section class="content">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Locations</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th>Phone</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($companies as $company)
                    <tr>
                        <td>{{ $company->id }}</td>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->email }}</td>
                        <td>
                            @foreach($company->cities as $city)
                                <span class="badge bg-primary">{{ $city->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <img src="{{ asset('assets/img/companies/'.$company->logo) }}" alt="logo" width="70" height="70">
                        </td>
                        <td>{{ $company->website }}</td>
                        <td>{{ $company->phone }}</td>
                        @if(strlen($company->description) > 50)
                            <td>{{ substr($company->description, 0, 50) }}...</td>
                        @else
                            <td>{{ $company->description }}</td>
                        @endif
                        <td>
                            <a href="{{route('admin.companies.show', $company->id)}}" class="btn btn-primary">View more...</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $companies->links()}}
            @if(session('success'))
                <p class="text-success mt-5 d-none" id="successMessage">
                    {{session('success')}}
                </p>
            @endif
        </section>
        <!-- /.content -->
    </div>
@endsection
