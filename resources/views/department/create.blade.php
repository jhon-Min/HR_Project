@extends('layouts.app')

@section('title')
    Create Department
@endsection


@section('banner')
    Department Create Form
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('department.store') }}" id="createForm" method="POST">
                             @csrf
                            <div class="md-form mb-3">
                                <label for="emp">Department Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('title') }}" name="title">
                                {{-- @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-theme m-0">Create Department</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreDepartment', '#createForm'); !!}
@endsection
