<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolClass;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get("class_id");
        $date = $request->get("date", now()->toDateString());
        $classes = SchoolClass::all();

        $students = collect();
        $attendances = collect();
        if ($classId) {
            $students = SchoolClass::find($classId)->students()->with("user")->get();
            $attendances = Attendance::where("date", $date)
                ->whereIn("student_id", $students->pluck("id"))->get()->keyBy("student_id");
        }

        return view("admin.attendance.index", compact("classes", "students", "attendances", "classId", "date"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "date" => "required|date",
            "students" => "required|array",
            "students.*.student_id" => "required|exists:students,id",
            "students.*.status" => "required|in:hadir,izin,sakit,alpha",
        ]);

        foreach ($data["students"] as $row) {
            Attendance::updateOrCreate(
                ["student_id" => $row["student_id"], "date" => $data["date"]],
                ["status" => $row["status"]]
            );
        }

        return back()->with("success", "Data kehadiran berhasil disimpan.");
    }
}
