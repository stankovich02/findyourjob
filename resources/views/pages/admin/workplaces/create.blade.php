@extends('layouts.admin-layout')
@section('title', 'Add Workplace')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.workplaces.store')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="workplaceName">Name</label>
                            <input type="text" name="name" class="form-control" id="workplaceName"/>
                            @if($errors->has('name'))
                                <p class="text-danger">
                                    {{$errors->first('name')}}
                                </p>
                            @endif
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

