@extends('layouts.app')

@section('title')
    {{ $employee->name }} Profile
@endsection

@section('head')
    <style>
        .btn-finger-print {
            border-radius: 15px;
            border: 2px solid #555;
        }

        .btn-finger-print .fp {
            font-size: 38px;
        }

        .btn-finger-print .plus {
            position: absolute;
            bottom: 3px;
            right: 5px;
        }

    </style>
@endsection

@section('banner')
    {{ $employee->name }}'s profile detail
@endsection

@section('content')
    <div class="container pt-3 pb-8">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                @include('layouts.profile-frame')

                <div class="card mt-3 bg-white shadow">
                    <div class="card-body">
                        <h5 class="mb-3">Add Fingerprint</h5>
                        <form id="biometric-register">
                            <button class="btn btn-white btn-finger-print border p-3 shadow-none">
                                <i class="fa-solid fa-fingerprint fp text-theme"></i>
                                <i class="fa-solid fa-circle-plus plus"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const register = (event) => {
            event.preventDefault()
            new Larapass({
                    register: "{{ route('webauthn.register') }}",
                    registerOptions: "{{ route('webauthn.register.options') }}"
                }).register()
                .then(response => alert('Registration successful!'))
                .catch(response => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!',
                    })
                })
        }

        document.getElementById('biometric-register').addEventListener('submit', register)
    </script>
@endsection
