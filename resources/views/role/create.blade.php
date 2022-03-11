@extends('layouts.app')

@section('title')
    Create Role
@endsection


@section('banner')
    Role Create Form
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body px-4 ">
                        <form action="{{ route('role.store') }}" id="createForm" method="POST">
                             @csrf
                            <div class="md-form mb-4">
                                <label for="emp">Role Name</label>
                                <input type="text" id="emp" class="form-control" value="{{ old('name') }}" name="name">
                                {{-- @error('employee_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror --}}
                            </div>

                            <div class="col-12">
                                <p class="mb-2 text-semi small font-weight-bolder">Permissions</p>
                                <div class="row">
                                        @foreach ($permissions as $permission)
                                        <div class="col-4 col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="defaultCheck{{ $permission->id }}">
                                                <label class="form-check-label" for="defaultCheck{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                        @endforeach
                                </div>
                            </div>

                            <div class="mt-5">
                                <button class="btn btn-theme m-0">Create Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {!! JsValidator::formRequest('App\Http\Requests\StoreRole', '#createForm'); !!}
@endsection
