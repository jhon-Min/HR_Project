<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Department;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function index()
    {
        if (!auth()->user()->can('view_employee')) {
            abort(403, 'Unauthorized action');
        }
        return view('employee.index');
    }

    public function ssd(Request $request)
    {
        if (!auth()->user()->can('view_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employees = User::query();
        return DataTables::of($employees)->addColumn('dep', function ($each) {
            return $each->department ? $each->department->title : '-';
        })
            ->filterColumn('dep', function ($query, $keyword) {
                $query->whereHas('department', function ($q) use ($keyword) {
                    $q->where('title', 'like', "%$keyword%");
                });
            })
            ->editColumn('is_present', function ($each) {
                if ($each->is_present == 1) {
                    return ' <span class="badge badge-pill badge-success p-2">Present</span>';
                } else {
                    return ' <span class="badge badge-pill badge-danger p-2">Leave</span>';
                }
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('role_name', function ($each) {
                $output = "";
                foreach ($each->roles as $role) {
                    $output .= "<span class='badge badge-pill badge-primary m-1 p-2'>$role->name</span>";
                }
                return $output;
            })
            ->addColumn('action', function ($each) {
                $edit = "";
                $detail = "";
                $del = "";

                if (auth()->user()->can('edit_employee')) {
                    $edit = '<a href="' . route('employee.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                }

                if (auth()->user()->can('view_employee')) {
                    $detail = '<a href="' . route('employee.show', $each->id) . '" class="btn btn-sm btn-secondary p-2 rounded mr-2"><i class="fa-solid fa-circle-info"></i></a>';
                }

                if (auth()->user()->can('delete_employee')) {
                    $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';
                }

                return '<div class="action-icon">' . $edit . $detail . $del . '</div>';
            })
            ->rawColumns(['is_present', 'action', 'role_name'])
            ->make(true);
    }

    public function create()
    {
        if (!auth()->user()->can('create_employee')) {
            abort(403, 'Unauthorized action');
        }
        $departments = Department::orderBy('title')->get();
        $roles = Role::orderBy('name')->get();
        return view('employee.create', compact('departments', 'roles'));
    }

    public function store(StoreEmployee $request)
    {
        if (!auth()->user()->can('create_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employee = new User();
        $employee->employee_id = $request->employee_id;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password = Hash::make($request->password);
        $employee->pin_code  = $request->pin_code;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->dep_id = $request->dep_id;
        $employee->birthday = $request->birthday;
        $employee->address = $request->address;
        $employee->date_of_join = $request->date_of_join;
        $employee->is_present = $request->is_present;

        if ($request->hasFile('profile_img')) {
            $file = $request->file('profile_img');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $newName, file_get_contents($file));

            $employee->profile_img = $newName;
        }

        $employee->syncRoles($request->roles);
        $employee->save();


        return redirect()->route('employee.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Employee is successfully created']);
    }

    public function edit($id)
    {
        if (!auth()->user()->can('edit_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employee = User::findOrFail($id);
        $departments = Department::orderBy('title')->get();
        $old_roles = $employee->roles->pluck('id')->toArray();
        $roles = Role::orderBy('name')->get();

        return view('employee.edit', compact('employee', 'departments', 'old_roles', 'roles'));
    }

    public function update(UpdateEmployee $request, $id)
    {
        if (!auth()->user()->can('edit_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employee = User::findOrFail($id);
        if ($request->hasFile('profile_img')) {
            Storage::disk('public')->delete('employee/' . $employee->profile_img);

            $file = $request->file('profile_img');
            $newName = 'profile_' . uniqid() . '.' . $file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $newName, file_get_contents($file));

            $employee->profile_img = $newName;
        }
        $employee->employee_id = $request->employee_id;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password = $request->password ? Hash::make($request->password) : $employee->password;
        $employee->pin_code  = $request->pin_code;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->dep_id = $request->dep_id;
        $employee->birthday = $request->birthday;
        $employee->address = $request->address;
        $employee->date_of_join = $request->date_of_join;
        $employee->is_present = $request->is_present;
        $employee->syncRoles($request->roles);
        $employee->update();

        return redirect()->route('employee.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => $employee->name . ' is successfully updated']);
    }

    public function show($id)
    {
        if (!auth()->user()->can('view_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employee = User::findOrFail($id);
        return view('employee.show', compact('employee'));
    }

    public function destroy($id)
    {
        if (!auth()->user()->can('delete_employee')) {
            abort(403, 'Unauthorized action');
        }
        $employee = User::findOrFail($id);
        Storage::disk('public')->delete('employee/' . $employee->profile_img);
        $employee->delete();
    }
}
