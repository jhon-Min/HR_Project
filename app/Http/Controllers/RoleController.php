<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRole;
use App\Http\Requests\UpdateRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        return view('role.index');
    }

    public function ssd(Request $request)
    {
        $role = Role::query();
        return DataTables::of($role)
            ->addColumn('permissions', function ($each) {
                $output = '';
                foreach ($each->permissions as $permission) {
                    $output .= "<span class='badge badge-pill badge-success m-1 p-2'>$permission->name</span>";
                }
                return $output;
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('role.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';

                $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';

                return "<div class='action-icon'>$edit $del</div>";
            })
            ->rawColumns(['action', 'permissions'])
            ->make(true);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }

    public function store(StoreRole $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->save();

        // assign role permission to pivot table
        $role->givePermissionTo($request->permissions);

        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => $role->name . ' role is successfully created']);
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        $old_permissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::all();

        return view('role.edit', compact('role', 'old_permissions', 'permissions'));
    }

    public function update(UpdateRole $request, $id)
    {
        $role = Role::findOrFail($id);
        $beforeName = $role->name;
        $old_permissions = $role->permissions->pluck('name')->toArray();
        $role->name = $request->name;
        $role->update();

        $role->revokePermissionTo($old_permissions);
        $role->givePermissionTo($request->permissions);
        return redirect()->route('role.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Updated! ' . $beforeName . ' to ' . $role->name]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }
}
