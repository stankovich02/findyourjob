@extends('layouts.admin-layout')
@section('title', 'Users')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        <a href="{{route('admin.users.create')}}" class="btn btn-primary m-3">Add user</a>
        <!-- Main content -->
        <section class="content">
            <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th style="width: 100px">LinkedIn</th>
                    <th style="width: 100px">GitHub</th>
                    <th>Avatar</th>
                    <th>Active</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="entityID">{{ $user->id }}</td>
                        <td class="entityName">{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->linkedin }}</td>
                        <td>{{ $user->github }}</td>
                        <td>
                            <img src="{{ asset('assets/img/users/'.$user->avatar) }}" alt="avatar" width="70" height="70">
                        <td>
                            @if($user->is_active)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            @if($user->role_id == 2)
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary">
                                <i class="fas fa-edit me-2"></i>  Edit</a>
                            <form @if($user->is_active) action="{{route('admin.users.ban', $user->id)}}" @else action="{{route('admin.users.unban', $user->id)}}" @endif  method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-secondary @if($user->is_active) banModal @else unBanModal @endif ">
                                 <!-- icon for ban user -->
                                    <i class="fas fa-ban me-2"></i>  @if($user->is_active) Ban @else Unban @endif
                                </button>
                            </form>
                            <form action="{{route('admin.users.destroy', $user->id)}}" method="POST" class="d-inline">
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
            {{ $users->links()}}
        </section>

        <!-- /.content -->
    </div>
    <div class="modal deleteUserModal" tabindex="-1">
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
    <div class="modal banUserModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
