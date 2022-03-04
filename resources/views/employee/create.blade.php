@extends('layouts.app')

@section('title')
    Create Employee
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('employee.store') }}" id="createForm" method="POST">
                             @csrf
                            <div class="md-form mb-3">
                                <label for="emp">Employee ID</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('employee_id') }}" name="employee_id">
                                @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" value="{{ old('name') }}" name="name">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="ph">Phone</label>
                                <input type="number" id="ph" class="form-control" value="{{ old('phone') }}" name="phone">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="eml">Email</label>
                                <input type="email" id="eml" class="form-control" value="{{ old('email') }}" name="email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="passwd">Password</label>
                                <input type="password" id="passwd" class="form-control" value="{{ old('password') }}" name="password">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="nrc">NRC</label>
                                <input type="text" id="ncr" class="form-control" value="{{ old('nrc_number') }}" name="nrc_number">
                                @error('nrc_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Choose Department</label>
                                <select class="form-control" name="dep_id">
                                    @foreach ($departments as $dep)
                                    <option value="{{ $dep->id }}" {{ $dep->id == old('dep_id') ? 'selected' : '' }}>{{ $dep->title }}</option>
                                    @endforeach
                                </select>
                                @error('dep_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="bd">Birthday</label>
                                <input type="text" id="bd" class="form-control" value="{{ old('birthday') }}" name="birthday">
                                @error('birthday')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="addr">Address</label>
                                <textarea class="form-control md-textarea" id="addr" name="address">{{ old('address') }}</textarea>
                                @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="md-form mb-3">
                                <label for="doj">Date of Join</label>
                                <input type="text" id="doj" class="form-control" value="{{ old('date_of_join') }}" name="date_of_join">
                                @error('date_of_join')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="text-black-50">Is Present</label>
                                <select class="form-control" name="is_present">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('is_pressent')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div>
                                <button class="btn btn-theme w-100 m-0">Create Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreEmployee', '#createForm'); !!}
    <script>
        $(document).ready(function () {
            $("#bd").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "maxDate": moment(),
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });

            $("#doj").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });
        });
    </script>
@endsection
