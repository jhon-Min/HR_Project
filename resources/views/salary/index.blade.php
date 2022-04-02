@extends('layouts.app')

@section('title')
    Salary Management
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                @can('create_salary')
                    <div class="mb-2">
                        <a href="{{ route('salary.create') }}" class="btn btn-theme px-3 font-weight-bold">
                            <i class=" fas fa-plus-circle"></i>
                            Create Salary
                        </a>
                    </div>
                @endcan

                <div class="card mb-8">
                    <div class="card-body">
                        <table class="table table-hover table-bordered w-100" id="dataTable">
                            <thead>
                                <th class="no-sort"></th>
                                <th class="text-center">Employee</th>
                                <th class="text-center">Month</th>
                                <th class="text-center">Year</th>
                                <th class="text-center">Amount (MMK)</th>
                                <th class="text-center no-sort">Action</th>
                                <th class="text-center hidden no-sort">Updated_at</th>
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
                ajax: '{{ route('salary.ssd') }}',
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
                        data: 'month',
                        name: 'month',
                        class: 'text-center'
                    },
                    {
                        data: 'year',
                        name: 'year',
                        class: 'text-center'
                    },
                    {
                        data: 'amount',
                        name: 'amount',
                        class: 'text-center'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        class: 'text-center'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        class: 'text-center'
                    },
                ],
                order: [
                    [4, "desc"]
                ],
            });

            $(document).on('click', '.del-btn', function(e, id) {
                e.preventDefault();

                var id = $(this).data("id");

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire("Deleted!", "Your file has been deleted.", "success");
                        $.ajax({
                            method: "DELETE",
                            url: `/salary/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
