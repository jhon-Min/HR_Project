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
                        <form action="{{ route('employee.store') }}" method="POST" autocomplete="off">
                             @csrf
                            <div class="md-form mb-3">
                                <label for="emp">Employee ID</label>
                                <input type="text" id="emp" class="form-control" name="emp_id">
                            </div>

                            <div class="md-form mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control" name="name">
                            </div>

                            <div class="md-form mb-3">
                                <label for="ph">Phone</label>
                                <input type="number" id="ph" class="form-control" name="phone">
                            </div>

                            <div class="md-form mb-3">
                                <label for="eml">Email</label>
                                <input type="email" id="eml" class="form-control" name="email">
                            </div>

                            <div class="md-form mb-3">
                                <label for="nrc">NRC</label>
                                <input type="text" id="ncr" class="form-control" name="nrc_number">
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Choose Department</label>
                                <select class="form-control" name="department">
                                    @foreach ($departments as $dep)
                                    <option value="{{ $dep->id }}">{{ $dep->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md-form mb-3">
                                <label for="bd">Birthday</label>
                                <input type="text" id="bd" class="form-control" name="birthday">
                            </div>

                            <div class="md-form mb-3">
                                <label for="addr">Address</label>
                                <textarea class="form-control md-textarea" id="addr" name="address"></textarea>
                            </div>

                            <div class="md-form mb-3">
                                <label for="doj">Date of Join</label>
                                <input type="text" id="doj" class="form-control" name="date_of_join">
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="text-black-50">Is Present</label>
                                <select class="form-control" name="gender">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
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
    <script>
        $(document).ready(function () {
            $("#bd").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "maxDate" : moment(),
                "showDropdowns": true,
                "locale": {
                    "format": "MM-DD-YYYY",
                }
            });

            $("#doj").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "MM-DD-YYYY",
                }
            });
        });
    </script>
@endsection
