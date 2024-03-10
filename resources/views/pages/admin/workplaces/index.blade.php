@extends('layouts.admin-layout')
@section('title', 'Workplaces')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <a href="{{route('admin.workplaces.create')}}" class="btn btn-primary m-3">Add workplace</a>
        <!-- Main content -->
        <section class="content pt-3">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($workplaces as $workplace)
                    <tr>
                        <td>{{ $workplace->id }}</td>
                        <td>{{ $workplace->name }}</td>
                        <td>
                            <a href="{{route('admin.workplaces.edit', $workplace->id)}}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>  Edit</a>
                            <form action="{{route('admin.workplaces.destroy', $workplace->id)}}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger deleteBtn">
                                    <i class="fas fa-trash me-2"></i>  Delete
                                </button>
                            </form>
                        </td>
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
        <!-- /.content -->
    </div>
    <div class="modal deleteWorkplaceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger" id="deleteModal">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection