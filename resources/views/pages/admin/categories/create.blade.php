@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.categories.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="catName">Name</label>
                            <input type="text" name="categoryName" class="form-control" id="catName">
                            @if($errors->has('categoryName'))
                                <p class="text-danger">
                                    {{$errors->first('categoryName')}}
                                </p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="" id="icon" name="icon">
                                </div>
                            </div>
                            @if($errors->has('icon'))
                                <p class="text-danger">
                                    {{$errors->first('icon')}}
                                </p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection

