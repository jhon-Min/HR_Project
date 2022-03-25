@extends('layouts.app')

@section('title')
    Edit User's Attendance
@endsection

@section('banner')
    Edit Attendance
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <x-bread-crumb>
                    <li class="breadcrumb-item"><a href="{{ route('attendance.index') }}">Attendance Lists</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Attendance</li>
                </x-bread-crumb>

                <div class="card">
                    <div class="card-body px-4 ">
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endforeach
                        <form action="{{ route('attendance.update', $attendance->id) }}" id="editForm" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Choose Employee</label>
                                <select class="form-control" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $user->id == old('user_id', $attendance->user_id) ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->employee_id }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md-form mb-3">
                                <label for="dt">Date</label>
                                <input type="text" id="dt" class="form-control"
                                    value="{{ old('date', $attendance->date) }}" name="date">
                            </div>

                            <div class="mb-4 md-form">
                                <label for="check-in">Check In</label>
                                <input type="text" id="check-in" class="form-control time-picker" name="check_in"
                                    value="{{ old('check_in', Carbon\Carbon::parse($attendance->check_in)->format('H:i:s')) }}">
                            </div>

                            <div class="mb-4 md-form">
                                <label for="check-out">Check Out</label>
                                <input type="text" id="check-out" class="form-control time-picker" name="check_out"
                                    value="{{ old('check_out', Carbon\Carbon::parse($attendance->check_out)->format('H:i:s')) }}">
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-theme m-0">Confirm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateAttendance', '#editForm') !!}

    <script>
        $(document).ready(function() {
            $("#dt").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "maxDate": moment(),
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });

            $(".time-picker").daterangepicker({
                "singleDatePicker": true,
                "timePicker": true,
                "timePicker24Hour": true,
                "timePickerSeconds": true,
                "autoApply": true,
                "locale": {
                    "format": "HH:mm:ss",
                }
            }).on('show.daterangepicker', function(ev, picker) {
                picker.container.find('.calendar-table').hide();
            });;
        });
    </script>
@endsection
