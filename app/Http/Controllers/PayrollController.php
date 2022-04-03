<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\CheckInOut;
use App\CompanySetting;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        return view('payroll.index');
    }

    public function payrollTable(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        // $dayInMonth = Carbon::parse($start)->daysInMonth;
        $dayInMonth = Carbon::now()->month($month)->daysInMonth;

        $workingDays = Carbon::parse($start)->subDays(1)->diffInDaysFiltered(function (Carbon $date) {
            return $date->isWeekday();
        }, Carbon::parse($end));

        $offDays = $dayInMonth - $workingDays;

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('employee_id', 'like', '%' . $request->employee_name . '%')->get();
        $company = CompanySetting::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('payroll.payroll-table', compact('periods', 'employees', 'company', 'attendances', 'dayInMonth', 'workingDays', 'offDays', 'month', 'year'));
    }
}
