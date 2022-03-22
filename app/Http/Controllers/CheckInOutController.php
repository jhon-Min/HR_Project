<?php

namespace App\Http\Controllers;

use App\CheckInOut;
use App\User;
use Illuminate\Http\Request;

class CheckInOutController extends Controller
{
    public function checkInOut()
    {
        return view('check-in-out');
    }

    public function checkIn(Request $request)
    {
        $user = User::where("pin_code", $request->pin_code)->first();

        if (!$user) {
            return [
                "status" => "error",
                "title" => "pin code is wrong."
            ];
        }

        if (CheckInOut::whereNotNull('check_in')->exists()) {
            return [
                "status" => "error",
                "title" => "Already Check In"
            ];
        }

        $check = new CheckInOut();
        $check->user_id = $user->id;
        $check->check_in = now();
        $check->save();

        return [
            "status" => "success",
            "title" => "Successfully Check In"
        ];
    }
}
