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
            <div class="col-12 col-md-8">
                <div class="card shadow">
                    <div class="card-body px-4">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-id-badge mr-1"></i>
                                        Employee ID
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->employee_id }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-phone mr-1"></i>
                                        Phone
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->phone }}</p>
                                </div>


                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-passport mr-1"></i>
                                        NRC
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->nrc_number }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-cake-candles mr-1"></i>
                                        Birthday
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->birthday }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-building mr-1"></i>
                                        Department
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->department->title }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-brands fa-hive mr-1"></i>
                                        Is Present?
                                    </p>
                                    @if ($employee->is_present == 1)
                                    <p class="font-weight-bold badge badge-pill badge-success p-2 px-3">Yes</p>
                                    @else
                                    <p class="font-weight-bold badge badge-pill badge-danger p-2 px-3">No</p>
                                    @endif

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-user mr-1"></i>
                                        Name
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-envelope m-1"></i>
                                        Email
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->email }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-mars-double mr-1"></i>
                                        Gender
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->gender }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-location-dot mr-1"></i>
                                        Address
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->address }}</p>
                                </div>

                                <div class="mb-4">
                                    <p class="mb-1 font-weight-bold text-black-50">
                                        <i class="fa-solid fa-calendar-days mr-1"></i>
                                        Date Of Join
                                    </p>
                                    <p class="h6 font-weight-normal">{{ $employee->date_of_join }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

