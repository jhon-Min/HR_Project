@extends('layouts.app')

@section('title')
    {{ $employee->name }} Profile
@endsection

@section('banner')
{{ $employee->name }}'s profile detail
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
              @include('layouts.profile-frame')
            </div>
        </div>
    </div>
@endsection

