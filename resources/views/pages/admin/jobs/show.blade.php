@extends('layouts.admin-layout')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
           <div class="container py-5">
               <div class="row">
                   <div class="col-12 d-flex flex-column align-items-center">
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Title:</p>
                           <h4>{{$job->name}}</h4>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Company:</p>
                           <p>{{$job->company->name}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Location:</p>
                           <p>{{$job->city->name}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Category:</p>
                           <p>{{$job->category->name}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Salary:</p>
                           <p>{{$job->salary ? $job->salary . "€" : "Not mentioned"}}</p>
                       </div>

                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Seniority:</p>
                           <p>{{$job->seniority->name}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Work type:</p>
                           <p>{{$job->full_time ? "Full Time" : "Part Time"}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Workplace:</p>
                           <p>{{$job->workplace->name}}</p>
                       </div>
                       <div class="single d-flex flex-column">
                           <p class="mb-0 font-weight-bold text-center">Description:</p>
                           {!!$job->description!!}
                       </div>
                       <div class="single d-flex flex-column">
                           <p class="mb-0 font-weight-bold text-center">Responsibilities:</p>
                           {!!$job->responsibilities!!}
                       </div>
                       <div class="single d-flex flex-column">
                           <p class="mb-0 font-weight-bold text-center">Requirements:</p>
                           {!!$job->requirements!!}
                       </div>
                       <div class="single d-flex flex-column">
                           <p class="mb-0 font-weight-bold text-center">Benefits:</p>
                           {!!$job->benefits!!}
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Application deadline:</p>
                           {{$job->application_deadline}}
                       </div>
                       @if($job->status == \App\Models\Job::STATUS_PENDING)

                           <div class="single d-flex text-center w-50 justify-content-around mt-5">
                                   <button type="submit" data-id="{{$job->id}}" class="btn btn-success mt-3 px-5" id="approveJob">Approve</button>
                                  <button type="submit" data-id="{{$job->id}}" class="btn btn-danger mt-3 px-5" id="deleteJob">Decline</button>
                           </div>
                           <button class="btn btn-primary mt-5 px-5" onclick="window.history.back()">Back</button>
                       @endif
                       @if($job->status == \App\Models\Job::STATUS_ACTIVE)
                       <button class="btn btn-primary mt-3 px-5" onclick="window.history.back()">Back</button>
                       @endif



                   </div>
               </div>
           </div>

        </section>
        <!-- /.content -->
    </div>

    <div class="modal deleteJobModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.jobs.destroy', $job->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Decline</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal approveJobModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.jobs.approve', $job->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
