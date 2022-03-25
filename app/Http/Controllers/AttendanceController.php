<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\CheckInOut;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAttendance;
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
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '-';
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

    public function edit(CheckInOut $attendance)
    {
        if (!auth()->user()->can('edit_attendance')) {
            abort(403, 'Unauthorized action');
        }
        return view('attendance.edit', compact('attendance'));
    }


    public function destroy(CheckInOut $attendance)
    {
        if (!auth()->user()->can('delete_attendance')) {
            abort(403, 'Unauthorized action');
        }
        $attendance->delete();
    }
}
