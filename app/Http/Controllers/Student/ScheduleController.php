<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $schedules = collect();
        if ($student && $student->class_id) {
            $schedules = Schedule::with(["subject", "teacher.user"])
                ->where("class_id", $student->class_id)
                ->orderBy("day")->orderBy("start_time")->get()->groupBy("day");
        }
        return view("student.schedule", compact("schedules", "student"));
    }
}
