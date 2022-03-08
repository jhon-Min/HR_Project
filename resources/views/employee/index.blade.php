@extends('layouts.app')

@section('title')
    Employee Lists
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
           <div class="col-12 col-md-10">
                <div class="mb-2">
                    <a href="{{ route('employee.create') }}" class="btn btn-theme px-3 font-weight-bold">
                        <i class=" fas fa-plus-circle"></i>
                        Create Employee
                    </a>
                </div>

                <div class="card mb-8">
                    <div class="card-body">
                        <table class="table table-hover table-bordered w-100" id="dataTable">
                            <thead>
                                <th class="no-sort"></th>
                                <th class="text-center">Employee ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Department</th>
                                <th class="text-center no-sort">Action</th>
                                <th class="text-center">Is Present</th>
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
        $(document).ready(function () {
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: '{{ route('emp.ssd') }}',
                columns: [
                    { data: 'plus-icon', name: 'plus-icon', class: 'text-center' },
                    { data: 'employee_id', name: 'employee_id', class: 'text-center' },
                    { data: 'name', name: 'name', class: 'text-center' },
                    { data: 'phone', name: 'phone', class: 'text-center' },
                    { data: 'email', name: 'email', class: 'text-center' },
                    { data: 'dep', name: 'dep', class: 'text-center' },
                    { data: 'action', name: 'action', class: 'text-center' },
                    { data: 'is_present', name: 'is_present', class: 'text-center' },
                    { data: 'updated_at', name: 'updated_at', class: 'text-center' },
                ],
                order: [
                    [8, "desc"]
                ],
                "columnDefs": [
                    {
                        "targets": "hidden",
                        "visible": false
                    },
                    {
                        "targets": [0],
                        "class": "control"
                    },
                    {
                        "targets": "no-sort",
                        "orderable": false
                    },

                ],
                "language": {
                    "paginate": {
                        "next": '<i class="fa-solid fa-circle-arrow-right pg-next h5"></i>',
                        "previous": '<i class="fa-solid fa-circle-arrow-left pg-pre h5"></i>'
                    },
                    "processing":'<div class="spinner-grow text-success" role="status"><span class="sr-only">.....Loading...</span></div>',
                }
            });
        })
  </script>
@endsection

