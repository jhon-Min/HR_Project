@extends('layouts.app')

@section('title')
    Company Setting
@endsection


@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-3 mb-md-0">
                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Company Name</span>
                                    <p>{{ $companySetting->name }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Company Email</span>
                                    <p>{{ $companySetting->email }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Office Start Time</span>
                                    <p>{{ $companySetting->office_start_time }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Break Start Time</span>
                                    <p>{{ $companySetting->break_start_time }}</p>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Company Phone</span>
                                    <p>{{ $companySetting->phone }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Company Address</span>
                                    <p>{{ $companySetting->address }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Office End Time</span>
                                    <p>{{ $companySetting->office_end_time }}</p>
                                </div>

                                <div class="mb-4">
                                    <span class="small text-semi font-weight-bolder">Office End Time</span>
                                    <p>{{ $companySetting->break_end_time }}</p>
                                </div>
                            </div>

                            @can('edit_company_setting')
                                <a href="{{ route('company-setting.edit', $companySetting->id) }}"
                                    class="btn btn-primary mt-4">
                                    Edit Company Setting
                                </a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
