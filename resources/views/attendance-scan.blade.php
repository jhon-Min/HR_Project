@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12 col-lg-9">
                <div class="card mb-4">
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
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card mb-8">
                    <div class="card-body">
                        <h5 class="mb-5 text-theme font-weight-bold">Attendance Records</h5>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group mb-3">
                                    <select class="form-control" name="" id="select-month">
                                        <option value="">---- Choose Month ----</option>
                                        <option value="01" @if (now()->format('m') == '01') selected @endif>Jan</option>
                                        <option value="02" @if (now()->format('m') == '02') selected @endif>Feb</option>
                                        <option value="03" @if (now()->format('m') == '03') selected @endif>Mar</option>
                                        <option value="04" @if (now()->format('m') == '04') selected @endif>Apr</option>
                                        <option value="05" @if (now()->format('m') == '05') selected @endif>May</option>
                                        <option value="06" @if (now()->format('m') == '06') selected @endif>Jun</option>
                                        <option value="07" @if (now()->format('m') == '07') selected @endif>Jul</option>
                                        <option value="08" @if (now()->format('m') == '08') selected @endif>Aug</option>
                                        <option value="09" @if (now()->format('m') == '09') selected @endif>Sep</option>
                                        <option value="10" @if (now()->format('m') == '10') selected @endif>Oct</option>
                                        <option value="11" @if (now()->format('m') == '11') selected @endif>Nov</option>
                                        <option value="12" @if (now()->format('m') == '12') selected @endif>Dec</option>
                                    </select>
                                </div>
                            </div>


                            <div class="col-4">
                                <div class="form-group">
                                    <select name="" class="form-control" id="select-year">
                                        <option value="">-- Please Choose (Year) --</option>
                                        @for ($i = 0; $i < 5; $i++)
                                            <option value="{{ now()->subYears($i)->format('Y') }}"
                                                @if (now()->format('Y') ==
    now()->subYears($i)->format('Y')) selected @endif>
                                                {{ now()->subYears($i)->format('Y') }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="col-4">
                                <button class="btn btn-theme btn-small btn-block btn-overview">Search</button>
                            </div>
                        </div>

                        <div class="overview-table mb-5"></div>

                        <table class="table table-hover table-bordered w-100" id="dataTable">
                            <thead>
                                <th class="no-sort"></th>
                                <th class="text-center">Employee</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Check-in Time</th>
                                <th class="text-center">Check-out Time</th>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#dataTable').DataTable({
                ajax: '{{ route('my-attendance.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'employee',
                        name: 'employee',
                        class: 'text-center'
                    },
                    {
                        data: 'date',
                        name: 'date',
                        class: 'text-center'
                    },
                    {
                        data: 'check_in',
                        name: 'check_in',
                        class: 'text-center'
                    },
                    {
                        data: 'check_out',
                        name: 'check_out',
                        class: 'text-center'
                    },
                ],
                order: [
                    [4, "desc"]
                ],
            });

            var videoElem = document.getElementById('vd');
            const qrScanner = new QrScanner(videoElem, function(result) {
                console.log(result);
                if (result) {
                    $('#scanBackdrop').modal('hide')
                    qrScanner.stop();
                    $.ajax({
                        url: "{{ route('attendance-scan.store') }}",
                        method: "POST",
                        data: {
                            "hash_value": result
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
                        }
                    })

                }
            });

            $('#scanBackdrop').on('shown.bs.modal', function(event) {
                qrScanner.start();
            })

            $('#scanBackdrop').on('hidden.bs.modal', function(event) {
                qrScanner.stop();
            })

            function overviewTable() {
                var month = $('#select-month').val();
                var year = $('#select-year').val();

                $.ajax({
                    url: `/my-overview?month=${month}&year=${year}`,
                    type: 'GET',
                    success: function(res) {
                        $('.overview-table').html(res);
                    }
                })

                table.ajax.url(`/my-attendance/datatable/ssd?month=${month}&year=${year}`).load();
            }

            $('.btn-overview').on('click', function(e) {
                e.preventDefault();
                overviewTable();
            })

            overviewTable();
        })
    </script>
@endsection
