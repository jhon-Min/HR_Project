<?php

namespace App\Http\Controllers;

use App\CompanySetting;
use App\Http\Requests\UpdateCompanySetting;
use Illuminate\Http\Request;

class CompanySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function show(CompanySetting $companySetting)
    {
        if (!auth()->user()->can('view_company_setting')) {
            abort(403, 'Unauthorized Action');
        }
        return view('company-setting.show', compact('companySetting'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanySetting $companySetting)
    {
        if (!auth()->user()->can('edit_company_setting')) {
            abort(403, 'Unauthorized Action');
        }
        return view('company-setting.edit', compact('companySetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanySetting $request, CompanySetting $companySetting)
    {
        $companySetting->name = $request->name;
        $companySetting->email = $request->email;
        $companySetting->phone = $request->phone;
        $companySetting->address = $request->address;
        $companySetting->office_start_time = $request->office_start_time;
        $companySetting->office_end_time = $request->office_end_time;
        $companySetting->break_start_time = $request->break_start_time;
        $companySetting->break_end_time = $request->break_end_time;
        $companySetting->update();

        return redirect()->route('company-setting.show',  $companySetting->id)->with('create_alert', ['icon' => 'success', 'title' => 'Successfully Updated', 'message' => 'Company Setting is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CompanySetting  $companySetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanySetting $companySetting)
    {
        //
    }
}
