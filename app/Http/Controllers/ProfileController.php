<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profile()
    {
        $employee = auth()->user();
        return view('user-profile.profile', compact('employee'));
    }
}
