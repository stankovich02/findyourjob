@extends('layouts.admin-layout')
@section('title', $data['title'])
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->
        @if($data['entityName'] != 'Company' && $data['entityName'] != 'Job' && $data['entityName'] != 'Pending Job' && $data['entityName'] != 'BoostedJob' && $data['entityName'] != 'Pending Company' && $data['entityName'] != 'Newsletter')
            <a href="{{route($data['route'] . '.create')}}" class="btn btn-primary m-3">Add {{$data['entityName']}}</a>
        @endif

        <!-- Main content -->
        <section class="content pt-3">
            @if($data['entityName'] == 'Pending Job' && count($data['values']) == 0)
                <h3 class="text-center">No pending jobs.</h3>
            @elseif($data['entityName'] == 'BoostedJob' && count($data['values']) == 0)
                <h3 class="text-center">No boosted jobs.</h3>
            @else
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        @foreach($data['columns'] as $column)
                            @if(str_contains($column,'_id'))
                                <th>{{explode('_',$column)[0]}}</th>
                                @continue
                            @endif
                            @if($column == 'password')
                                @continue
                            @endif
                            @if($column == 'token')
                                @continue
                            @endif
                                @if(($column == 'description' || $column == 'responsibilities' || $column == 'requirements' || $column == 'benefits') && $data['entityName'] == 'Job')
                                    @continue
                                @endif
                            <th>{{$column}}</th>
                        @endforeach
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data['values'] as $val)
                        <tr>
                            @foreach($data['columns'] as $col)
                                @switch($col)
                                    @case('icon')
                                        <td><img src="{{asset('assets/img/' .$val->$col)}}" style="width: 70px;height: 70px" alt="icon"/></td>
                                        @break
                                    @case('avatar')
                                        <td><img src="{{asset('assets/img/users/' . $val->$col)}}" style="width: 70px;height: 70px" alt="icon"/></td>
                                        @break
                                    @case('logo')
                                        <td><img src="{{asset('assets/img/companies/' . $val->$col)}}" style="width: 70px;height: 70px" alt="{{$val->name}}"/></td>
                                        @break
                                @endswitch
                                @if($col == 'icon' || $col == 'avatar' || $col == 'logo')
                                    @continue
                                @endif
                                @if($col == 'id')
                                    <td class="entityID">{{ $val->$col }}</td>
                                    @continue
                                @endif
                                @if($col == 'name')
                                    <td class="entityName">{{ $val->$col }}</td>
                                    @continue
                                @endif
                                @if(($col == 'description' || $col == 'responsibilities' || $col == 'requirements' || $col == 'benefits') && $data['entityName'] == 'Job')
                                    @continue
                                @endif
                                @if($col == 'description')
                                    @if(strlen($val->$col) > 50)
                                        <td>{{ substr($val->$col, 0, 50) }}...</td>
                                    @else
                                        <td>{{ $val->$col }}</td>
                                    @endif
                                    @continue
                                @endif
                                @if(str_contains($col,'_id'))
                                    @php
                                    $relation = explode('_',$col)[0];
                                    @endphp
                                    <td>{{$val->$relation->name}}</td>
                                    @continue
                                @endif
                                @if($col == 'salary')
                                    @if($val->salary == 0)
                                        <td>Not mentioned</td>
                                    @else
                                        <td>{{ $val->salary }}&euro;</td>
                                    @endif
                                    @continue
                                @endif
                                @if($col == 'password')
                                    @continue
                                @endif
                                @if($col == 'token')
                                    @continue
                                @endif
                                @if($col == 'is_active')
                                    <td>
                                        @if($val->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    @continue
                                @endif
                                @if($col == 'role_id')
                                    <td>
                                        @if($val->$col == 2)
                                            <span class="badge bg-primary">Admin</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    @continue
                                @endif
                                    <td>{{ $val->$col }}</td>
                          @endforeach
                                @if($data['entityName'] == 'Company' || $data['entityName'] == 'Job' || $data['entityName'] == 'Pending Company')
                                    <td>
                                        <a href="{{route($data['route'] . '.show', $val->id)}}" class="btn btn-primary">View more...</a>
                                    </td>
                                @elseif($data['entityName'] == 'User' && $val->id != session()->get('user')->id)
                                    <td>
                                        <a href="{{route($data['route'] . '.edit', $val->id)}}" class="btn btn-primary">
                                            <i class="fas fa-edit me-2"></i>  Edit</a>
                                        <form @if($val->is_active) action="{{route('admin.users.ban', $val->id)}}" @else action="{{route('admin.users.unban', $val->id)}}" @endif  method="POST" class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="my-1 btn btn-secondary @if($val->is_active) banModal @else unBanModal @endif ">
                                                <!-- icon for ban user -->
                                                <i class="fas fa-ban me-2"></i>  @if($val->is_active) Ban @else Unban @endif
                                            </button>
                                        </form>
                                        <form action="{{route($data['route'] . '.destroy', $val->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger deleteBtn">
                                                <i class="fas fa-trash me-2"></i>  Delete
                                            </button>
                                        </form>
                                    </td>
                                @elseif($data['entityName'] == 'User' && $val->id == session()->get('user')->id)
                                    <td>
                                        <a href="{{route($data['route'] . '.edit', $val->id)}}" class="btn btn-primary">
                                            <i class="fas fa-edit me-2"></i>  Edit</a>
                                    </td>
                                @elseif($data['entityName'] == 'BoostedJob' || $data['entityName'] == 'Newsletter')
                                    <td>
                                        <form action="{{$data['entityName'] == 'BoostedJob' ? route($data['route'] . '.destroy_boosted', $val->id) : route($data['route'] . '.destroy', $val->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger deleteBtn">
                                                <i class="fas fa-trash me-2"></i>  Delete
                                            </button>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <a href="{{route($data['route'] . '.edit', $val->id)}}" class="btn btn-primary">
                                            <i class="fas fa-edit me-2"></i>  Edit</a>
                                        <form action="{{route($data['route'] . '.destroy', $val->id)}}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger deleteBtn">
                                                <i class="fas fa-trash me-2"></i>  Delete
                                            </button>
                                        </form>
                                    </td>
                                @endif
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
                @if($data['entityName'] == 'City' || $data['entityName'] == 'Company' || $data['entityName'] == 'User' || $data['entityName'] == 'Job' || $data['entityName'] == 'Technology')
                    {{ $data['values']->links()}}
                @endif
            @endif
        </section>
        <!-- /.content -->
    </div>
    <div class="modal delete{{$data['entityName']}}Modal" tabindex="-1">
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

