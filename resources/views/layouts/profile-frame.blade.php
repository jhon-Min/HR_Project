<div class="card shadow">
    <div class="card-body px-4">
        <div class="row">
           <div class="col-12 col-md-7">
              <div class="text-md-center">
                <img src="{{ asset($employee->profile_img_path()) }}" alt="" class="emp-profile-circle shadow">
                <div class="mt-3">
                    <h4>{{ $employee->name }}</h4>
                    <div class="text-semi h6">
                        <span>{{ $employee->employee_id }}</span> | <span class="text-theme">{{ $employee->phone }}</span>
                    </div>
                     <span class="small badge-pill badge-dark px-2 py-1">{{ $employee->department->title }}</span>
                </div>
              </div>
           </div>

            <div class="col-12 col-md-5 border-dash mt-5 mt-md-0">
                <div>
                    <div class="mb-3">
                        <span class="font-weight-bold">
                            Email :
                        </span>
                        <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->email }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="font-weight-bold">
                            NRC :
                        </span>
                        <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->nrc_number }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="font-weight-bold">
                            Gender :
                        </span>
                        <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->gender }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="font-weight-bold">
                            Birthday :
                        </span>
                        <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->birthday }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="font-weight-bold">
                            Date Of Join :
                        </span>
                        <span class="h6 font-weight-normal ml-1 text-semi">{{ $employee->date_of_join }}</span>
                    </div>

                    <div class="mb-3">
                        <span class="font-weight-bold">
                            Is Present :
                        </span>
                        @if ($employee->is_present == 1)
                        <p class="font-weight-bold badge badge-pill badge-success p-2 px-3 mb-0">Yes</p>
                        @else
                        <p class="font-weight-bold badge badge-pill badge-danger p-2 px-3 mb-0">No</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
