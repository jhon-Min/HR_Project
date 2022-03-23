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

    public function checkProcess(Request $request)
    {
        $user = User::where("pin_code", $request->pin_code)->first();

        if (!$user) {
            return [
                "status" => "error",
                "title" => "pin code is wrong."
            ];
        }

        $check = CheckInOut::firstOrCreate([
            'user_id' => $user->id,
            'date' => now()->format('Y-m-d')
        ]);

        if (!is_null($check->check_in) && !is_null($check->check_out)) {
            return [
                "status" => "info",
                "title" => "Already check-in and check-out today."
            ];
        }

        if (is_null($check->check_in)) {
            $check->check_in = now();
            $title =  "Successfully Check In";
            $message = $user->name . ' သည် ' . now() . ' တွင် check-in ကိုပြုလုပ်ပါသည်။';
        } else {
            if (is_null($check->check_out)) {
                $check->check_out = now();
                $title = "Successfully Check Out";
                $message = $user->name . ' သည် ' . now() . ' တွင် check-out ကိုပြုလုပ်ပါသည်။';
            }
        }

        $check->update();

        return [
            "status" => "success",
            "title" => $title,
            "message" => $message
        ];
    }
}
