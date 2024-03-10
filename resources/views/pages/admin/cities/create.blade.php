
@extends('layouts.admin-layout')
@section('title', 'Create City')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.cities.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="cityName">Name</label>
                            <input type="text" name="cityName" class="form-control" id="cityName">
                            @if($errors->has('cityName'))
                                <p class="text-danger">
                                    {{$errors->first('cityName')}}
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
