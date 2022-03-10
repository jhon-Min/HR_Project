<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePermission;
use App\Http\Requests\UpdatePermission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        return view('permission.index');
    }

    public function ssd(Request $request)
    {
        $permission = Permission::query();
        return DataTables::of($permission)
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('permission.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';

                $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';

                return '<div class="action-icon">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        return view('permission.create');
    }

    public function store(StorePermission $request)
    {
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();

        return redirect()->route('permission.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Permission is successfully created']);
    }

    public function edit($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit', compact('permission'));
    }

    public function update(UpdatePermission $request, $id)
    {
        $permission = Permission::findOrFail($id);
        $permission->name = $request->name;
        $permission->update();

        return redirect()->route('permission.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Permission is successfully updated']);
    }

    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }
}
