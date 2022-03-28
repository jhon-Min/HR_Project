@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('img/QR code_Monochromatic.png') }}" alt="" style="width: 250px">
                        <p class="text-muted">Please Scan Attendance QR</p>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-theme mt-4" data-toggle="modal" data-target="#scanBackdrop">
                            <i class="fa-solid fa-qrcode mr-2"></i>
                            Scan QR
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="scanBackdrop" data-backdrop="static" data-keyboard="false"
                            tabindex="-1" aria-labelledby="scanBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="scanBackdropLabel">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <video id="vd" class="w-100 h-25"></video>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Understood</button>
                                    </div>
                                </div>
                            </div>
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
            var videoElem = document.getElementById('vd');
            const qrScanner = new QrScanner(videoElem, function(result) {
                console.log(result);
                if (result) {
                    $('#scanBackdrop').modal('hide')
                    qrScanner.stop();
                }
            });

            $('#scanBackdrop').on('shown.bs.modal', function(event) {
                qrScanner.start();
            })

            $('#scanBackdrop').on('hidden.bs.modal', function(event) {
                qrScanner.stop();
            })
        })
    </script>
@endsection
