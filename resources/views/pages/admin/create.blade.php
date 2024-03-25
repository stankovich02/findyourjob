@extends('layouts.admin-layout')
@section('title', 'Create ' . $data['entityName'])
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.'.$data['resourceName'].'.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        @foreach($data['columns'] as $col)
                            @if($col != 'id' && $col != 'is_active' && $col != 'token'  && $col != 'created_at' && $col != 'updated_at')
                                @if($col == 'avatar' || $col == 'icon')
                                    <div class="form-group">
                                        <label for="{{$col}}">{{$col}}</label>
                                        <br/>
                                        <input type="file" name="{{$col}}" id="{{$col}}">
                                        @if($errors->has($col))
                                            <p class="text-danger">
                                                {{$errors->first($col)}}
                                            </p>
                                        @endif
                                    </div>
                                    @continue
                                @endif
                                @if(str_contains($col,'_id'))
                                    @php
                                        $relation = explode('_',$col)[0];
                                    @endphp
                                    <div class="form-group">
                                        <label for="{{$relation}}">{{$relation}}</label>
                                        <select name="{{$col}}" class="form-control" id="{{$relation}}">
                                            @foreach($data[$relation] as $val)
                                                <option value="{{$val->id}}">{{$val->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has($col))
                                            <p class="text-danger">
                                                {{$errors->first($col)}}
                                            </p>
                                        @endif
                                    </div>
                                    @continue
                                @endif
                                <div class="form-group">
                                    <label for="{{$col}}">{{$col}}</label>
                                    <input type="text" name="{{$col}}" class="form-control" id="{{$col}}" value="{{old($col)}}">
                                    @if($errors->has($col))
                                        <p class="text-danger">
                                            {{$errors->first($col)}}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        @endforeach

                     {{--   <div class="form-group">
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
                        </div>--}}
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


