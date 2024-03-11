@extends('layouts.admin-layout')
@section('title', 'Categories')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <a href="{{route('admin.categories.create')}}" class="btn btn-primary m-3">Add Category</a>
        <!-- Main content -->
        <section class="content pt-3">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Icon</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="entityID">{{ $category->id }}</td>
                        <td class="entityName">{{ $category->name }}</td>
                        <td><img src="{{asset('assets/img/' . $category->icon)}}" style="width: 50px;height: 50px" alt="icon"/></td>
                        <td>
                            <a href="{{route('admin.categories.edit', $category->id)}}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>  Edit</a>
                            <form action="{{route('admin.categories.destroy', $category->id)}}" method="POST" class="d-inline">
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
    <div class="modal deleteCategoryModal" tabindex="-1">
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
