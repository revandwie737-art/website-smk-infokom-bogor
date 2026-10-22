<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $attendances = $student ? $student->attendances()->latest("date")->paginate(20) : collect();
        $percentage = $student ? $student->attendancePercentage() : 0;
        return view("student.attendance", compact("attendances", "percentage", "student"));
    }
}
