@extends('layouts.app')

@section('title')
    Edit Company Setting
@endsection

@section('head')
    <style>
        .calendar-table {
            display: none !important;
        }

    </style>
@endsection

@section('banner')
    {{ $companySetting->name }}
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('company-setting.update', $companySetting->id) }}" id="editForm"
                            method="Post">
                            @csrf
                            @method('put')

                            <div class="row px-4">
                                <div class="col-12 col-md-6">
                                    <div class="mb-4 md-form">
                                        <label for="c-name">Company Name</label>
                                        <input type="text" id="c-name" class="form-control" name="name"
                                            value="{{ old('name', $companySetting->name) }}">
                                    </div>

                                    <div class="mb-4 md-form">
                                        <label for="c-email">Company Email</label>
                                        <input type="email" id="c-email" class="form-control" name="email"
                                            value="{{ old('email', $companySetting->email) }}">
                                    </div>

                                    <div class="mb-4 md-form">
                                        <label for="c-ph">Company Phone</label>
                                        <input type="number" id="c-ph" class="form-control" name="phone"
                                            value="{{ old('name', $companySetting->phone) }}">
                                    </div>


                                    <div class="mb-4">
                                        <label for="c-addr" class="text-muted">Company Address</label>
                                        <textarea class="form-control" name="address" id="c-addr" rows="3">{{ $companySetting->address }}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 col-md-6">
                                    <div class="mb-4 md-form">
                                        <label for="os-time">Office Start Time</label>
                                        <input type="text" id="os-time" class="form-control time-picker"
                                            name="office_start_time" value="{{ $companySetting->office_start_time }}">
                                    </div>

                                    <div class="mb-4 md-form">
                                        <label for="bs-time">Break Start Time</label>
                                        <input type="text" id="bs-time" class="form-control time-picker"
                                            name="break_start_time" value="{{ $companySetting->break_start_time }}">
                                    </div>

                                    <div class="mb-4 md-form">
                                        <label for="oe-time">Office End Time</label>
                                        <input type="text" id="oe-time" class="form-control time-picker"
                                            name="office_end_time" value="{{ $companySetting->office_end_time }}">
                                    </div>

                                    <div class="mb-4 md-form">
                                        <label for="be-time">Break End Time</label>
                                        <input type="text" id="be-time" class="form-control time-picker"
                                            name="break_end_time" value="{{ $companySetting->break_end_time }}">
                                    </div>


                                </div>

                                <button type="submit" class="btn btn-success mt-4">
                                    Confirm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateCompanySetting', '#editForm') !!}
    <script>
        $(document).ready(function() {
            $(".time-picker").daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "autoApply": true,
                "locale": {
                    "format": "HH:mm:ss",
                }
            });
        });
    </script>
@endsection
