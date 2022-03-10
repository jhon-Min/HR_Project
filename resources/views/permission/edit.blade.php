@extends('layouts.app')

@section('title')
    Edit Permission
@endsection


@section('banner')
   <span class="small"> Edit {{ $permission->name }} permission</span>
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('permission.update', $permission->id) }}" id="editForm" method="POST">
                             @csrf
                             @method('put')
                            <div class="md-form mb-3">
                                <label for="emp">Department Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('name', $permission->name) }}" name="name">
                                {{-- @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
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
    {!! JsValidator::formRequest('App\Http\Requests\UpdatePermission', '#editForm'); !!}
@endsection
