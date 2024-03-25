@extends('layouts.admin-layout')
@section('title', 'Edit ' . $data['entityName'])
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <section class="content w-50 mx-auto pt-5">
            <div class="card card-primary ">
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{route('admin.'.$data['resourceName'].'.update', $data['entity']->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @foreach($data['columns'] as $col)
                            @if($col != 'id' && $col != 'is_active' && $col != 'token'  && $col != 'created_at' && $col != 'updated_at')
                                @if($col == 'avatar' || $col == 'icon')
                                    <div class="form-group">
                                        <label for="{{$col}}">{{$col}}</label>
                                        <br/>
                                        <img src="{{$col == 'avatar' ? asset('assets/img/users/' . $data['entity']->$col) : asset('assets/img/' . $data['entity']->$col)}}" style="width: 70px;height: 70px" alt="icon"/>
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
                            @if($col == 'password')
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
                                                <option value="{{$val->id}}" {{$data['entity']->$col == $val->id ? "selected" : ""}}>{{$val->name}}</option>
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
                                    <input type="text" name="{{$col}}" class="form-control" id="{{$col}}" value="{{$data['entity']->$col}}">
                                    @if($errors->has($col))
                                        <p class="text-danger">
                                            {{$errors->first($col)}}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        @endforeach
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection



