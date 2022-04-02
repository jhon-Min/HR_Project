<?php

namespace App\Http\Controllers;

use App\User;
use DateTime;
use App\Salary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreSalaryRequest;
use App\Http\Requests\UpdateSalaryRequest;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!auth()->user()->can('view_salary')) {
            abort(403, 'Unauthorized action');
        }


        return view('salary.index');
    }

    public function ssd(Request $request)
    {
        $salaries = Salary::query();
        return DataTables::of($salaries)
            ->filterColumn('employee', function ($query, $keyword) {
                $query->whereHas('employee', function ($q) use ($keyword) {
                    $q->where('name', 'like', "%$keyword%");
                });
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->update_at)->format('Y-m-d H:i:s');
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->addColumn('employee', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->editColumn('month', function ($each) {
                return Carbon::parse("2021-$each->month-01")->format('M');
            })
            ->editColumn('amount', function ($each) {
                return number_format($each->amount);
            })
            ->addColumn('action', function ($each) {
                $edit = '';
                $del = '';

                if (auth()->user()->can('edit_salary')) {
                    $edit = '<a href="' . route('salary.edit', $each->id) . '" class="btn btn-sm btn-info p-2 rounded mr-2"><i class="fa-solid fa-pen-to-square"></i></a>';
                }

                if (auth()->user()->can('delete_salary')) {
                    $del = '<a href="#" class="btn btn-sm btn-danger p-2 rounded del-btn" data-id="' . $each->id . '"><i class="fa-solid fa-trash-alt"></i></a>';
                }

                return '<div class="action-icon">' . $edit . $del . '</div>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->can('create_salary')) {
            abort(403, 'Unauthorized action');
        }

        $employees = User::all();
        return view('salary.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaryRequest $request)
    {
        $salary = new Salary();
        $salary->user_id = $request->user_id;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->amount = $request->amount;
        $salary->save();

        return redirect()->route('salary.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Created', 'message' => 'Salary is successfully created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function show(Salary $salary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function edit(Salary $salary)
    {
        $employees = User::all();
        return view('salary.edit', compact('salary', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaryRequest  $request
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryRequest $request, Salary $salary)
    {
        $salary->user_id = $request->user_id;
        $salary->month = $request->month;
        $salary->year = $request->year;
        $salary->amount = $request->amount;
        $salary->update();

        return redirect()->route('salary.index')->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Salary is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Salary  $salary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Salary $salary)
    {
        if (!auth()->user()->can('delete_salary')) {
            abort(403, 'Unauthorized action');
        }
        $salary->delete();
    }
}
