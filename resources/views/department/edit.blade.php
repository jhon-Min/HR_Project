@extends('layouts.app')

@section('title')
    Edit Department
@endsection


@section('banner')
   <span class="small"> Edit {{ $department->title }} Department</span>
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('department.update', $department->id) }}" id="editForm" method="POST">
                             @csrf
                             @method('put')
                            <div class="md-form mb-3">
                                <label for="emp">Department Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('title', $department->title) }}" name="title">
                                {{-- @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-theme m-0">Update Department</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\UpdateDepartment', '#editForm'); !!}
@endsection
