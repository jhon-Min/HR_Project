@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="text-center">
                        <img src="{{ asset($employee->profile_img_path()) }}" alt="" class="emp-profile-circle shadow">
                        <div class="mt-3">
                            <h4>{{ $employee->name }}</h4>
                            <div class="text-semi h6">
                                <span>{{ $employee->employee_id }}</span> | <span class="text-theme">{{ $employee->phone }}</span>
                            </div>
                             <span class="small badge-pill badge-dark px-2 py-1">{{ $employee->department->title }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
