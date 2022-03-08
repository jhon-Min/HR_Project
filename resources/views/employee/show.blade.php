@extends('layouts.app')

@section('title')
    Employee Detail
@endsection

@section('banner')
    Employee Create Form
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card shadow">
                    <div class="card-body px-4">
                        <div class="row justify-content-center">
                           <div class="col-7">
                              <div class="d-flex align-items-center">
                                <img src="{{ asset($employee->profile_img_path()) }}" alt="" class="emp-profile-circle shadow">
                                <div class="ml-3">
                                    <h4>{{ $employee->name }}</h4>
                                    <p class="text-semi h6 mb-1">{{ $employee->department->title }}</p>
                                    <p class="text-semi h6">{{ $employee->employee_id }}</p>
                                </div>
                              </div>
                           </div>

                            <div class="col-5 border-dash">
                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Phone :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->phone }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Email :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->email }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        NRC :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->nrc_number }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Gender :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->gender }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Birthday :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->birthday }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Date Of Join :
                                    </span>
                                    <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->date_of_join }}</span>
                                </div>

                                <div class="mb-3">
                                    <span class="font-weight-bold">
                                        Is Present :
                                    </span>
                                    @if ($employee->is_present == 1)
                                    <p class="font-weight-bold badge badge-pill badge-success p-2 px-3 mb-0">Yes</p>
                                    @else
                                    <p class="font-weight-bold badge badge-pill badge-danger p-2 px-3 mb-0">No</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

