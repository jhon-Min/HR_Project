@extends('layouts.app')

@section('title')
    Department Lists
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-11">
                @can('create_department')
                    <div class="mb-2">
                        <a href="{{ route('department.create') }}" class="btn btn-theme px-3 font-weight-bold">
                            <i class=" fas fa-plus-circle"></i>
                            Create Department
                        </a>
                    </div>
                @endcan

                <div class="card mb-8">
                    <div class="card-body">
                        <table class="table table-hover table-bordered w-100" id="dataTable">
                            <thead>
                                <th class="no-sort"></th>
                                <th class="text-center">Department</th>
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
                ajax: '{{ route('department.ssd') }}',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon',
                        class: 'text-center'
                    },
                    {
                        data: 'title',
                        name: 'title',
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
                    [3, "desc"]
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
                            url: `/department/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
