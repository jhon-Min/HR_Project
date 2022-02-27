<?php

namespace App\Http\Controllers;

use App\Department;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee.index');
    }

    public function ssd(Request $request)
    {
        $employees = User::query();
        return DataTables::of($employees)->addColumn('dep', function ($each) {
            return $each->department ? $each->department->title : '-';
        })
            ->editColumn('is_present', function ($each) {
                if ($each->is_present == 1) {
                    return ' <span class="badge badge-pill badge-success p-2">Present</span>';
                } else {
                    return ' <span class="badge badge-pill badge-danger p-2">Leave</span>';
                }
            })
            ->rawColumns(['is_present'])
            ->make(true);
    }

    public function create()
    {
        $departments = Department::orderBy('title')->get();
        return view('employee.create', compact('departments'));
    }

    public function store(Request $request)
    {
        return $request;
    }
}
