@extends('layouts.app-plain')

@section('title')
    Check In Check Out Page
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-center mb-3">Pin Code</h4>
                        <input type="text" name="mycode" id="pincode-input1">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#pincode-input1').pincodeInput({
            inputs: 4
        });
    </script>
@endsection
