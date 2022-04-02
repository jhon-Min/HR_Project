@extends('layouts.app')

@section('title')
    Edit Salary
@endsection


@section('banner')
    Salary Edit Form
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('salary.update', $salary->id) }}" id="editForm" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="">Employee</label>
                                <select name="user_id" class="form-control select-ninja">
                                    <option value="">-- Please Choose --</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}"
                                            @if (old('user_id', $salary->user_id) == $employee->id) selected @endif>{{ $employee->employee_id }}
                                            ({{ $employee->name }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Month</label>
                                <select name="month" class="form-control select-month">
                                    <option value="">-- Please Choose (Month) --</option>
                                    <option value="01" @if ($salary->month == '01') selected @endif>Jan</option>
                                    <option value="02" @if ($salary->month == '02') selected @endif>Feb</option>
                                    <option value="03" @if ($salary->month == '03') selected @endif>Mar</option>
                                    <option value="04" @if ($salary->month == '04') selected @endif>Apr</option>
                                    <option value="05" @if ($salary->month == '05') selected @endif>May</option>
                                    <option value="06" @if ($salary->month == '06') selected @endif>Jun</option>
                                    <option value="07" @if ($salary->month == '07') selected @endif>Jul</option>
                                    <option value="08" @if ($salary->month == '08') selected @endif>Aug</option>
                                    <option value="09" @if ($salary->month == '09') selected @endif>Sep</option>
                                    <option value="10" @if ($salary->month == '10') selected @endif>Oct</option>
                                    <option value="11" @if ($salary->month == '11') selected @endif>Nov</option>
                                    <option value="12" @if ($salary->month == '12') selected @endif>Dec</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Year</label>
                                <select name="year" class="form-control select-year">
                                    <option value="">-- Please Choose (Year) --</option>
                                    @for ($i = 0; $i <= 3; $i++)
                                        <option value="{{ now()->addYears(3)->subYears($i)->format('Y') }}"
                                            @if ($salary->year ==
    now()->addYears(3)->subYears($i)->format('Y')) selected @endif>
                                            {{ now()->addYears(3)->subYears($i)->format('Y') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="md-form mb-5">
                                <label for="emp">Amount (MMK)</label>
                                <input type="number" id="emp" class="form-control"
                                    value="{{ old('amount', $salary->amount) }}" name="amount">
                            </div>

                            <div class="">
                                <button class="btn btn-theme m-0">Update Salary Info</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateSalaryRequest', '#editForm') !!}

    <script>
        $(document).ready(function() {
            $('.select-ninja').select2({
                placeholder: '-- Please Choose --',
                allowClear: true,
                theme: 'bootstrap4',
            });

            $('.select-month').select2({
                placeholder: '-- Please Choose (Month) --',
                allowClear: true,
                theme: 'bootstrap4'
            });

            $('.select-year').select2({
                placeholder: '-- Please Choose (Year) --',
                allowClear: true,
                theme: 'bootstrap4'
            });
            z
        });
    </script>
@endsection
