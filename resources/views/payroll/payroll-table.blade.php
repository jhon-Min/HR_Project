<div class="table-responsive mt-4">
    <table class="table table-bordered">
        <thead>
            <th>Employee</th>
            <th>Role</th>
            <th>Days of Month</th>
            <th>Off Day</th>
            <th>Attendance Day</th>
            <th>Leave</th>
            <th>Per Day(MMK)</th>
            <th>Total(MMK)</th>
        </thead>

        <tbody>
            @foreach ($employees as $employee)
                <tr>
                    <td>
                        <span>
                            {{ $employee->name }}
                        </span>
                        <span>
                            ({{ $employee->employee_id }})
                        </span>
                    </td>
                    <td>{{ implode(', ', $employee->roles->pluck('name')->toArray()) }}</td>
                    <td>{{ $dayInMonth }}</td>
                    @foreach ($periods as $period)
                        @php
                            $checkin_icon = '';
                            $checkout_icon = '';
                            $office_start_time = $period->format('Y-m-d') . ' ' . $company->office_start_time;
                            $office_end_time = $period->format('Y-m-d') . ' ' . $company->office_end_time;
                            $break_start_time = $period->format('Y-m-d') . ' ' . $company->break_start_time;
                            $break_end_time = $period->format('Y-m-d') . ' ' . $company->break_end_time;

                            $attendance = collect($attendances)
                                ->where('user_id', $employee->id)
                                ->where('date', $period->format('Y-m-d'))
                                ->first();

                            if ($attendance) {
                                if ($attendance->check_in < $office_start_time) {
                                    $checkin_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                } elseif ($attendance->check_in > $office_start_time and $attendance->check_in < $break_start_time) {
                                    $checkin_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                } else {
                                    $checkin_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                }

                                if ($attendance->check_out < $break_end_time) {
                                    $checkout_icon = '<i class="fa-solid fa-circle-xmark text-danger"></i>';
                                } elseif ($attendance->check_out < $office_end_time and $attendance->check_out > $break_end_time) {
                                    $checkout_icon = '<i class="fa-solid fa-circle-check text-warning"></i>';
                                } else {
                                    $checkout_icon = '<i class="fa-solid fa-circle-check text-success"></i>';
                                }
                            }
                        @endphp

                        <td @if ($period->format('D') == 'Sat' or $period->format('D') == 'Sun') class="bg-light" @endif>
                            <div>{!! $checkin_icon !!}</div>
                            <div>{!! $checkout_icon !!}</div>
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
