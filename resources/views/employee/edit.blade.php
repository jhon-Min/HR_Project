@extends('layouts.app')

@section('title')
    Edit Employee
@endsection

@section('banner')
    Employee Edit Form
@endsection

@section('content')
    <div class="container pt-5 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <div class="mb-5 position-relative">
                            <img src="{{ $employee->profile_img_path() }}" alt=""
                                class="border shadow-sm emp-edit-profile">
                            <button class="btn btn-sm position-absolute emp-profile-btn" id="upload-ui">
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </div>

                        <form action="{{ route('employee.update', $employee->id) }}" id="editForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <input type="file" accept="image/jpeg,image/png" id="profile-input" class="d-none"
                                name="profile_img">

                            <div class="md-form mb-3">
                                <label for="emp">Employee ID</label>
                                <input type="text" id="emp" class="form-control"
                                    value="{{ old('employee_id', $employee->employee_id) }}" name="employee_id">
                                {{-- @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="name">Name</label>
                                <input type="text" id="name" class="form-control"
                                    value="{{ old('name', $employee->name) }}" name="name">
                                {{-- @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="ph">Phone</label>
                                <input type="number" id="ph" class="form-control"
                                    value="{{ old('phone', $employee->phone) }}" name="phone">
                                {{-- @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="eml">Email</label>
                                <input type="email" id="eml" class="form-control"
                                    value="{{ old('email', $employee->email) }}" name="email">
                                {{-- @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="passwd">Password</label>
                                <input type="password" id="passwd" class="form-control" value="{{ old('password') }}"
                                    name="password">
                                {{-- @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="nrc">NRC</label>
                                <input type="text" id="ncr" class="form-control"
                                    value="{{ old('nrc_number', $employee->nrc_number) }}" name="nrc_number">
                                {{-- @error('nrc_number')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Gender</label>
                                <select class="form-control" name="gender">
                                    <option value="male" @if ($employee->gender == 'male') selected @endif>Male</option>
                                    <option value="female" @if ($employee->gender == 'female') selected @endif>Female</option>
                                </select>
                                {{-- @error('gender')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Choose Department</label>
                                <select class="form-control" name="dep_id">
                                    @foreach ($departments as $dep)
                                        <option value="{{ $dep->id }}"
                                            {{ $employee->dep_id == $dep->id ? 'selected' : '' }}>{{ $dep->title }}
                                        </option>
                                    @endforeach
                                </select>
                                {{-- @error('dep_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-black-50">Choose Role</label>
                                <select class="form-control select-custom-multiple" name="roles[]" multiple>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            @if (in_array($role->id, $old_roles)) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="md-form mb-3">
                                <label for="bd">Birthday</label>
                                <input type="text" id="bd" class="form-control"
                                    value="{{ old('birthday', $employee->birthday) }}" name="birthday">
                                {{-- @error('birthday')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="addr">Address</label>
                                <textarea class="form-control md-textarea" id="addr"
                                    name="address">{{ old('address', $employee->address) }}</textarea>
                                {{-- @error('address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="md-form mb-3">
                                <label for="doj">Date of Join</label>
                                <input type="text" id="doj" class="form-control"
                                    value="{{ old('date_of_join', $employee->date_of_join) }}" name="date_of_join">
                                {{-- @error('date_of_join')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="form-group mb-5">
                                <label for="" class="text-black-50">Is Present</label>
                                <select class="form-control" name="is_present">
                                    <option value="1" @if ($employee->is_present == 1) selected @endif>Yes</option>
                                    <option value="0" @if ($employee->is_present == 0) selected @endif>No</option>
                                </select>
                                {{-- @error('is_pressent')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div>
                                <button class="btn btn-theme w-100 m-0">Update Employee</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateEmployee', '#editForm') !!}
    <script>
        $(document).ready(function() {
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

            let input = document.getElementById("profile-input");
            let addBtn = document.getElementById("upload-ui");
            let profile = document.querySelector(".emp-edit-profile");

            addBtn.addEventListener("click", (_e) => input.click());
            input.addEventListener("change", _ => {
                let file = input.files[0];
                let reader = new FileReader();
                reader.onload = function() {
                    profile.src = reader.result;
                }
                reader.readAsDataURL(file);
            })
        });
    </script>
@endsection
