<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $student = Auth::user()->student;
        $todaySchedule = collect();

        if ($student && $student->class_id) {
            $dayMap = ["Monday" => "senin", "Tuesday" => "selasa", "Wednesday" => "rabu", "Thursday" => "kamis", "Friday" => "jumat", "Saturday" => "sabtu", "Sunday" => null];
            $today = $dayMap[now()->format("l")] ?? null;
            if ($today) {
                $todaySchedule = Schedule::with(["subject", "teacher.user"])
                    ->where("class_id", $student->class_id)->where("day", $today)
                    ->orderBy("start_time")->get();
            }
        }

        $announcements = Announcement::active()->latest()->take(5)->get();
        $recentGrades = $student ? $student->grades()->with("subject")->latest()->take(5)->get() : collect();
        $attendancePercentage = $student ? $student->attendancePercentage() : 0;

        return view("student.dashboard", compact("student", "todaySchedule", "announcements", "recentGrades", "attendancePercentage"));
    }
}
