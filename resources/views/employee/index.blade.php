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

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered" id="dataTable">
                            <thead>
                                <th class="text-center">Employee ID</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Phone</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Department</th>
                                <th class="text-center">Is Present</th>
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
                ajax: '{{ route('emp.ssd') }}',
                columns: [
                    { data: 'employee_id', name: 'employee_id', class: 'text-center' },
                    { data: 'name', name: 'name', class: 'text-center' },
                    { data: 'phone', name: 'phone', class: 'text-center' },
                    { data: 'email', name: 'email', class: 'text-center' },
                    { data: 'dep', name: 'dep', class: 'text-center' },
                    { data: 'is_present', name: 'is_present', class: 'text-center' },
                ]
            });
        })
  </script>
@endsection

