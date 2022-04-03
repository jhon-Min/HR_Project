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
                        <form action="{{ route('project.store') }}" id="createForm" method="POST">
                            @csrf
                            <div class="md-form mb-3">
                                <label for="emp">Project Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('title') }}" name="title">
                            </div>

                            <div class="md-form mb-3">
                                <label for="des">Address</label>
                                <textarea class="form-control md-textarea" rows="3" id="des" name="description">{{ old('description') }}</textarea>
                            </div>

                            <div class="md-form mb-3">
                                <label for="dt">Start Date</label>
                                <input type="text" id="dt" class="form-control datepicker" value="{{ old('start_date') }}"
                                    name="start_date">
                            </div>

                            <div class="md-form mb-3">
                                <label for="dl">Deadline</label>
                                <input type="text" id="dl" class="form-control datepicker" value="{{ old('deadline') }}"
                                    name="deadline">
                            </div>

                            <div class="form-group mb-3">
                                <label for="" class="text-muted">Priority</label>
                                <select name="priority" class="form-control select-priority">
                                    <option value="">-- Please Choose --</option>
                                    <option value="high">High</option>
                                    <option value="middle">Middle</option>
                                    <option value="low">Low</option>
                                </select>
                            </div>

                            <div class="form-group mb-3">
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
                placeholder: '-- Please Choose (Month) --',
                allowClear: true,
                theme: 'bootstrap4'
            });

            $('.select-status').select2({
                placeholder: '-- Please Choose (Year) --',
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
        });
    </script>
@endsection
