@extends('layouts.admin-layout')
@section('title', 'Technologies')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Main content -->
        <form action="{{route('admin.user-actions.index')}}" method="GET" class="px-3">
            <label for="date">Filter by date</label>
           <input type="date" name="date" id="date" class="form-control w-25" value="{{request()->get('date')}}"/>
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
        </form>
        <section class="content pt-3">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Path</th>
                    <th>Method</th>
                    <th>User ID</th>
                    <th>Action</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userActions as $userAction)
                    <tr>
                        <td class="entityID">{{ $userAction->id }}</td>
                        <td class="entityName">{{ $userAction->ip_address }}</td>
                        <td>{{ $userAction->path }}</td>
                        <td>{{ $userAction->method }}</td>
                        <td>{{ $userAction->user_id }}</td>
                        <td>{{ $userAction->action }}</td>
                        <td>{{ $userAction->created_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
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
        {{$userActions->links()}}
        <!-- /.content -->
    </div>
@endsection
