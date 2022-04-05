@extends('layouts.app')

@section('title')
    Project Lists
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                @can('create_project')
                    <div class="mb-2">
                        <a href="{{ route('project.create') }}" class="btn btn-theme px-3 font-weight-bold">
                            <i class=" fas fa-plus-circle"></i>
                            Create Project
                        </a>
                    </div>
                @endcan

                <x-bread-crumb>
                    <li class="breadcrumb-item active" aria-current="page">Projects</li>
                </x-bread-crumb>

                <div class="card mb-8">
                    <div class="card-body">
                        <table class="table table-hover table-bordered w-100" id="dataTable">
                            <thead>
                                <th class="no-sort"></th>
                                <th class="text-center">Project Name</th>
                                <th class="text-center no-sort">Leaders</th>
                                <th class="text-center no-sort">Members</th>
                                <th class="text-center">Start Date</th>
                                <th class="text-center">Deadline</th>
                                <th class="text-center">Priority</th>
                                <th class="text-center">Status</th>
                                <th class="text-center no-sort">Action</th>
                                <th class="text-center hidden">Updated_at</th>
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
                ajax: '{{ route('project.ssd') }}',
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
                        data: 'leaders',
                        name: 'leaders',
                        class: 'text-center'
                    },
                    {
                        data: 'members',
                        name: 'members',
                        class: 'text-center'
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                        class: 'text-center'
                    },
                    {
                        data: 'deadline',
                        name: 'deadline',
                        class: 'text-center'
                    },
                    {
                        data: 'priority',
                        name: 'priority',
                        class: 'text-center'
                    },
                    {
                        data: 'status',
                        name: 'status',
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
                    [9, "desc"]
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
                            url: `/project/${id}`,
                        }).done(function(res) {
                            table.ajax.reload();
                        })
                    }
                });
            })
        })
    </script>
@endsection
