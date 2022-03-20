<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckInOutController extends Controller
{
    public function checkInOut()
    {
        return view('check-in-out');
    }
}
