<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\CheckInOut;
use App\CompanySetting;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendance;
use App\Http\Requests\UpdateAttendance;
use Carbon\CarbonPeriod;
use Yajra\DataTables\Facades\DataTables;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance.index');
    }

    public function ssd(Request $request)
    {
        $attendances = CheckInOut::with('employee');
        return DataTables::of($attendances)
            ->filterColumn('employee', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('employee_id', 'like', "%$keyword%");
                });
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->employee_id : '-';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '';
                $del = '';

                if (auth()->user()->can('edit_attendance')) {
                    $edit = '<a href="' . route('attendance.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                }

                if (auth()->user()->can('delete_attendance')) {
                    $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';
                }

                return '<div class="action-icon">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        if (!auth()->user()->can('create_department')) {
            abort(403, 'Unauthorized action');
        }
        $users = User::orderBy('name')->get();
        return view('attendance.create', compact('users'));
    }

    public function store(StoreAttendance $request)
    {
        if (CheckInOut::where('user_id', $request->user_id)->where('date', $request->date)->exists()) {
            // return back()->with('toast', ['icon' => 'error', 'title' => 'Already Defined.']);
            return back()->withErrors(['fail' => 'Already defined.'])->withInput();
        }

        $attendance = new CheckInOut();
        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->check_in = $request->date . ' ' . $request->check_in;
        $attendance->check_out = $request->date . ' ' . $request->check_out;
        $attendance->save();

        return redirect()->route('attendance.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'New attendance is successfully created']);
    }

    public function show(CheckInOut $attendance)
    {
    }

    public function edit(CheckInOut $attendance)
    {
        if (!auth()->user()->can('edit_attendance')) {
            abort(403, 'Unauthorized action');
        }
        $users = User::orderBy('name')->get();
        return view('attendance.edit', compact('attendance', 'users'));
    }

    public function update(UpdateAttendance $request, CheckInOut $attendance)
    {
        if (CheckInOut::where('user_id', $request->user_id)->where('id', '!=', $attendance->id)->where('date', $request->date)->exists()) {
            // return back()->with('toast', ['icon' => 'error', 'title' => 'Already Defined.']);
            return back()->withErrors(['fail' => 'Already defined.'])->withInput();
        }

        $attendance->user_id = $request->user_id;
        $attendance->date = $request->date;
        $attendance->check_in = $request->date . ' ' . $request->check_in;
        $attendance->check_out = $request->date . ' ' . $request->check_out;
        $attendance->update();

        return redirect()->route('attendance.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Attendance is successfully updated']);
    }


    public function destroy(CheckInOut $attendance)
    {
        if (!auth()->user()->can('delete_attendance')) {
            abort(403, 'Unauthorized action');
        }
        $attendance->delete();
    }

    public function overview(Request $request)
    {
        if (!auth()->user()->can('view_attendance_overview')) {
            abort(403, 'Unauthorized action');
        }

        return view('attendance.overview');
    }

    public function overviewTable(Request $request)
    {
        if (!auth()->user()->can('view_attendance_overview')) {
            abort(403, 'Unauthorized action');
        }

        $month = $request->month;
        $year = $request->year;
        $start = $year . '-' . $month . '-01';
        $end = Carbon::parse($start)->endOfMonth()->format('Y-m-d');

        $periods = new CarbonPeriod($start, $end);
        $employees = User::orderBy('employee_id')->where('employee_id', 'like', '%' . $request->employee_name . '%')->get();
        $company = CompanySetting::findOrFail(1);
        $attendances = CheckInOut::whereMonth('date', $month)->whereYear('date', $year)->get();
        return view('components.overview-table', compact('periods', 'employees', 'company', 'attendances'));
    }
}
