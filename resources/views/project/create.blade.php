@extends('layouts.app')

@section('title')
    Create Department
@endsection


@section('banner')
    Project Create Form
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('project.store') }}" id="createForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="md-form mb-4">
                                <label for="emp">Project Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('title') }}" name="title">
                            </div>

                            <div class="md-form mb-4">
                                <label for="des">Address</label>
                                <textarea class="form-control md-textarea" rows="3" id="des" name="description">{{ old('description') }}</textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label for="profile_img" class="text-muted">Images</label>
                                <input type="file" name="images[]" class="form-control p-1 d-none" id="profile_img" multiple
                                    accept="image/.png,.jpg,.jpeg">

                                <div class="border rounded p-3 @error('images') broder border-danger @enderror">
                                    <div class="d-flex align-items-center">
                                        <div class="d-flex justify-content-center align-items-center bg-light border py-2 px-3 emp-profile"
                                            id="upload-ui">
                                            <i class="fas fa-upload fs-4"></i>
                                        </div>

                                        <div class="preview_img my-2 ml-3">
                                        </div>
                                    </div>
                                </div>
                                @error('images')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-muted">Files (Only PDF)</label>
                                <input type="file" class="form-control p-1" name="files[]" multiple
                                    accept="application/pdf">
                            </div>

                            <div class="md-form mb-4">
                                <label for="dt">Start Date</label>
                                <input type="text" id="dt" class="form-control datepicker" value="{{ old('start_date') }}"
                                    name="start_date">
                            </div>

                            <div class="md-form mb-4">
                                <label for="dl">Deadline</label>
                                <input type="text" id="dl" class="form-control datepicker" value="{{ old('deadline') }}"
                                    name="deadline">
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-black-50">Project Leader</label>
                                <select class="form-control select-custom-multiple" name="leaders[]" multiple>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}
                                            ({{ $employee->employee_id }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-black-50">Project Members</label>
                                <select class="form-control select-custom-multiple" name="members[]" multiple>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee->id }}">{{ $employee->name }}
                                            ({{ $employee->employee_id }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-muted">Priority</label>
                                <select name="priority" class="form-control select-priority">
                                    <option value="">-- Please Choose --</option>
                                    <option value="high">High</option>
                                    <option value="middle">Middle</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label for="" class="text-muted">Status</label>
                                <select name="status" class="form-control select-status">
                                    <option value="">-- Please Choose --</option>
                                    <option value="pending">Pending</option>
                                    <option value="in_progress">In Progress</option>
                                    <option value="complete">Complete</option>
                                </select>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-theme m-0">Create Project</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreProjectRequest', '#createForm') !!}

    <script>
        $(document).ready(function() {
            $('.select-priority').select2({
                placeholder: '-- Please Choose --',
                allowClear: true,
                theme: 'bootstrap4'
            });

            $('.select-status').select2({
                placeholder: '-- Please Choose --',
                allowClear: true,
                theme: 'bootstrap4'
            });

            $(".datepicker").daterangepicker({
                "singleDatePicker": true,
                "autoApply": true,
                "showDropdowns": true,
                "locale": {
                    "format": "YYYY-MM-DD",
                }
            });

            let input = document.getElementById('profile_img');
            document.getElementById('upload-ui').addEventListener("click", _ => input.click());

            $('#profile_img').on('change', function() {
                var file_length = input.files.length;
                $('.preview_img').html('');
                for (var i = 0; i < file_length; i++) {
                    $('.preview_img').append(`<img src="${URL.createObjectURL(event.target.files[i])}"/>`);
                }
            });
        });
    </script>
@endsection
