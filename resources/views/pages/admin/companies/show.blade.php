@extends('layouts.admin-layout')
@section('title', 'Company Details')
@section('content')
    <div class="content-wrapper" style="min-height: 1302.12px;">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
           <div class="container py-5">
               <div class="row">
                   <div class="col-12 d-flex flex-column align-items-center">
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Name:</p>
                           <h4>{{$company->name}}</h4>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Logo:</p>
                            <img class="mx-auto" src="{{ asset('assets/img/companies/'.$company->logo) }}" alt="logo" width="70" height="70">
                           <span class="font-small">
                               Note: Companies can upload their logos after they are approved.
                           </span>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Email:</p>
                           <p>{{$company->email}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Website:</p>
                           <p>
                               @if($company->website)
                                      <a href="{{$company->website}}" target="_blank">{{$company->website}}</a>
                                 @else
                                   No website provided.
                               @endif
                           </p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Phone:</p>
                           <p>{{$company->phone}}</p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Locations:</p>
                           <p>
                               @if(count($company->cities) == 1)
                                   {{$company->cities[0]->name}}
                               @else
                                   @foreach($company->cities as $city)
                                       @if($loop->last)
                                           {{$city->name}}
                                           @break
                                       @endif
                                       {{$city->name}},
                                   @endforeach
                               @endif

                           </p>
                       </div>
                       <div class="single d-flex flex-column text-center">
                           <p class="mb-0 font-weight-bold">Description:</p>
                           <p>{{$company->description}}</p>
                       </div>
                       @if($company->status == \App\Models\Company::STATUS_PENDING)
                           <div class="single d-flex text-center w-50 justify-content-around mt-5">
                                   <button type="submit" data-id="{{$company->id}}" class="btn btn-success mt-3 px-5" id="approveCompany">Approve</button>
                                  <button type="submit" data-id="{{$company->id}}" class="btn btn-danger mt-3 px-5" id="deleteCompany">Decline</button>
                           </div>
                           <button class="btn btn-primary mt-5 px-5" onclick="window.history.back()">Back</button>
                       @endif
                       @if($company->status == \App\Models\Company::STATUS_ACTIVE)
                       <button class="btn btn-primary mt-3 px-5" onclick="window.history.back()">Back</button>
                       @endif



                   </div>
               </div>
           </div>

        </section>
        <!-- /.content -->
    </div>

    <div class="modal deleteCompanyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.companies.destroy', $company->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Decline</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal approveCompanyModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="closeModal" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{route('admin.companies.approve', $company->id)}}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Approve</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
