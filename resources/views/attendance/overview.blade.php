@extends('layouts.app')

@section('title')
    Attendance Overview
@endsection

@section('banner')
    Attendance Overview
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <select class="form-control" name="">
                                        <option value="">---- Choose Month ----</option>
                                        <option value="01">Jan</option>
                                        <option value="02">Feb</option>
                                        <option value="03">Mar</option>
                                        <option value="04">Apr</option>
                                        <option value="05">May</option>
                                        <option value="06">Jun</option>
                                        <option value="07">Jul</option>
                                        <option value="08">Aug</option>
                                        <option value="09">Sep</option>
                                        <option value="10">Oct</option>
                                        <option value="11">Nov</option>
                                        <option value="12">Dec</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-5">
                                <div class="form-group">
                                    <select name="" class="form-control">
                                        <option value="">-- Please Choose (Year) --</option>
                                        @for ($i = 0; $i < 5; $i++)
                                            <option value="{{ now()->subYears($i)->format('Y') }}">
                                                {{ now()->subYears($i)->format('Y') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-3">
                                <button class="btn btn-theme btn-small btn-block">Search</button>
                            </div>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-bordered">
                                <thead>
                                    <th>Employee</th>
                                    @foreach ($periods as $period)
                                        <th>{{ $period->format('d') }}</th>
                                    @endforeach
                                </thead>

                                <tbody>
                                    @foreach ($employees as $employee)
                                        <tr>
                                            <td>{{ $employee->employee_id }}</td>
                                            @foreach ($periods as $period)
                                                @php
                                                    $checkin_icon = '';
                                                    $checkout_icon = '';
                                                    $office_start_time = $period->format('Y-m-d') . ' ' . $company->office_start_time;
                                                    $office_end_time = $period->format('Y-m-d') . ' ' . $company->office_end_time;
                                                    $break_start_time = $period->format('Y-m-d') . ' ' . $company->break_start_time;
                                                    $break_end_time = $period->format('Y-m-d') . ' ' . $company->break_end_time;

                                                    $attendance = collect($attendances)
                                                        ->where('user_id', $employee->id)
                                                        ->where('date', $period->format('Y-m-d'))
                                                        ->first();

                                                    if ($attendance) {
                                                        if ($attendance->check_in < $office_start_time) {
                                                            $checkin_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                                        } elseif ($attendance->check_in > $office_start_time and $attendance->check_in < $break_start_time) {
                                                            $checkin_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                                        } else {
                                                            $checkin_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                                        }

                                                        if ($attendance->check_out < $break_end_time) {
                                                            $checkout_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                                        } elseif ($attendance->check_out < $office_end_time and $attendance->check_out > $break_end_time) {
                                                            $checkout_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                                        } else {
                                                            $checkout_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                                        }
                                                    }
                                                @endphp

                                                <td>
                                                    <div>{!! $checkin_icon !!}</div>
                                                    <div>{!! $checkout_icon !!}</div>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
