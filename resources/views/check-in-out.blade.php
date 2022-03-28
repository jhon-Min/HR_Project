@extends('layouts.app-plain')

@section('title')
    Check In Check Out Page
@endsection

@section('head')
    <style>
        .qr-img {
            width: 190px;
        }

    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-10 col-lg-7">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-5">
                            <img src="data:image/png;base64, {!! base64_encode(
    QrCode::format('png')->size(100)->generate($hash_value),
) !!} " class="qr-img">
                            <p class="text-muted mt-3">Please scan QR to check-in and check-out</p>
                            <hr>
                        </div>

                        <div class="px-4 mb-5">
                            <h5 class="text-center mb-3">Pin Code</h5>
                            <input type="text" name="mycode" id="pincode-input1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#pincode-input1').pincodeInput({
                inputs: 6,
                hidedigits: true,
                complete: function(value, e, errorElement) {
                    console.log("code entered: " + value);

                    $.ajax({
                        url: "{{ route('check-process') }}",
                        method: "POST",
                        data: {
                            "pin_code": value
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                Swal.fire({
                                    icon: res.status,
                                    title: res.title,
                                    text: res.message,
                                })
                            } else {
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top',
                                    showConfirmButton: false,
                                    timer: 2500,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter',
                                            Swal.stopTimer)
                                        toast.addEventListener('mouseleave',
                                            Swal
                                            .resumeTimer)
                                    }
                                })

                                Toast.fire({
                                    icon: res.status,
                                    title: res.title,
                                })
                            }

                            $('.pincode-input-container .pincode-input-text').val("");
                            $('.pincode-input-text').first().select().focus();
                        }
                    })


                    /*do some code checking here*/

                    // $(errorElement).html("I'm sorry, but the code not correct");
                }
            });
            $('.pincode-input-text').first().select().focus();
        })
    </script>
@endsection
