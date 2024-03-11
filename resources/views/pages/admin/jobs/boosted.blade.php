@extends('layouts.admin-layout')
@section('title', 'Boosted Jobs')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Main content -->
        <section class="content pt-3">
            @if(count($boostedJobs) == 0)
                <h3 class="text-center pt-3">No boosted jobs.</h3>
            @else
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Company</th>
                        <th>Boosted At</th>
                        <th>Boosted Until</th>
                        <th>Boosted days</th>
                        <th>Total price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($boostedJobs as $job)
                        <tr>
                            <td class="entityID">{{ $job->boosted->id }}</td>
                            <td class="entityName">{{ $job->name }}</td>
                            <td>{{ $job->company->name }}</td>
                            <td>{{ $job->boosted->boosted_at }}</td>
                            <td>{{ $job->boosted->boosted_until }}</td>
                            <td>{{ $job->boosted->boosted_days }}</td>
                            <td>{{ $job->boosted->total }}&euro;</td>
                            <td>
                                <form action="{{route('admin.jobs.destroy_boosted', $job->boosted->id)}}" method="POST" class="d-inline">
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
            @endif
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
    <div class="modal deleteBoostedJobModal" tabindex="-1">
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

