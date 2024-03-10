@extends('layouts.admin-layout')
@section('title', 'Newsletters')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Main content -->
        <section class="content">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($newsletters as $newsletter)
                    <tr>
                        <td>{{ $newsletter->id }}</td>
                        <td>{{ $newsletter->email }}</td>
                        <td>
                            <form action="{{route('admin.newsletters.destroy', $newsletter->id)}}" method="POST" class="d-inline">
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
    <div class="modal deleteNewsletterModal" tabindex="-1">
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
