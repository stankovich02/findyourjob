@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.users.update', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="firstName">First name</label>
                            <input type="text" name="firstName" class="form-control" id="firstName" value="{{$user->first_name}}">
                            @if($errors->has('firstName'))
                                <p class="text-danger">
                                    {{$errors->first('firstName')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" value="{{$user->last_name}}">
                            @if($errors->has('lastName'))
                                <p class="text-danger">
                                    {{$errors->first('lastName')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="linkedin">LinkedIn</label>
                            <input type="text" name="linkedin" class="form-control" id="linkedin" value="{{$user->linkedin}}">
                            @if($errors->has('linkedin'))
                                <p class="text-danger">
                                    {{$errors->first('linkedin')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="github">GitHub</label>
                            <input type="text" name="github" class="form-control" id="github" value="{{$user->github}}">
                            @if($errors->has('github'))
                                <p class="text-danger">
                                    {{$errors->first('github')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <br/>
                            <img src="{{ asset('assets/img/users/'.$user->avatar) }}" alt="avatar" width="70" height="70">
                            <br/>
                            <input type="file" name="avatar" id="avatar">
                            @if($errors->has('avatar'))
                                <p class="text-danger">
                                    {{$errors->first('avatar')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                            @if($errors->has('email'))
                                <p class="text-danger">
                                    {{$errors->first('email')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" class="form-control" id="role">
                                @foreach($roles as $role)
                                    <option @if($user->role_id == $role->id) selected @endif value="{{$role->id}}">{{$role->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('role'))
                                <p class="text-danger">
                                    {{$errors->first('role')}}
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
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
