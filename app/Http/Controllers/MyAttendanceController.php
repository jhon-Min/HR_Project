<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\CheckInOut;
use App\CompanySetting;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MyAttendanceController extends Controller
{
    public function myAttendance(Request $request)
    {
        $attendance = CheckInOut::with('employee')->where('user_id', auth()->user()->id);

        if ($request->month) {
            $attendance = $attendance->whereMonth('date', $request->month);
        }

        if ($request->year) {
            $attendance = $attendance->whereYear('date', $request->year);
        }
        return DataTables::of($attendance)
            ->filterColumn('employee', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->make(true);
    }

    public function myOverview(Request $request)
    {
        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('id', auth()->user()->id)->get();
        $company = CompanySetting::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('components.overview-table', compact('periods', 'employees', 'company', 'attendances'));
    }
}
