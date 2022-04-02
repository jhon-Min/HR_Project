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
        $dayInMonth = Carbon::parse($start)->daysInMonth;

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('employee_id', 'like', '%' . $request->employee_name . '%')->get();
        $company = CompanySetting::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('payroll.payroll-table', compact('periods', 'employees', 'company', 'attendances', 'dayInMonth'));
    }
}
