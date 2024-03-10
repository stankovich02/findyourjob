
@extends('layouts.admin-layout')
@section('title', 'Add Navigation')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.navs.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="navName">Name</label>
                            <input type="text" name="navName" class="form-control" id="navName">
                            @if($errors->has('navName'))
                                <p class="text-danger">
                                    {{$errors->first('navName')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="navRoute">Route</label>
                            <input type="text" name="navRoute" class="form-control" id="navRoute">
                            @if($errors->has('navRoute'))
                                <p class="text-danger">
                                    {{$errors->first('navRoute')}}
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
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
