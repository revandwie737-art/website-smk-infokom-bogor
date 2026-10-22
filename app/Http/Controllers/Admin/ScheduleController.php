<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get("class_id");
        $classes = SchoolClass::all();
        $schedules = Schedule::with(["subject", "teacher.user"])
            ->when($classId, fn ($q) => $q->where("class_id", $classId))
            ->orderBy("day")->orderBy("start_time")->get();
        return view("admin.schedules.index", compact("schedules", "classes", "classId"));
    }

    public function create()
    {
        return view("admin.schedules.form", [
            "schedule" => new Schedule(),
            "classes" => SchoolClass::all(),
            "subjects" => Subject::all(),
            "teachers" => Teacher::with("user")->get(),
        ]);
    }

    public function store(Request $request)
    {
        Schedule::create($this->validated($request));
        return redirect()->route("admin.schedules.index")->with("success", "Jadwal berhasil disimpan.");
    }

    public function edit(Schedule $schedule)
    {
        return view("admin.schedules.form", [
            "schedule" => $schedule,
            "classes" => SchoolClass::all(),
            "subjects" => Subject::all(),
            "teachers" => Teacher::with("user")->get(),
        ]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $schedule->update($this->validated($request));
        return redirect()->route("admin.schedules.index")->with("success", "Jadwal berhasil diperbarui.");
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();
        return back()->with("success", "Jadwal berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "class_id" => "required|exists:classes,id",
            "subject_id" => "required|exists:subjects,id",
            "teacher_id" => "nullable|exists:teachers,id",
            "day" => "required|in:senin,selasa,rabu,kamis,jumat,sabtu",
            "start_time" => "required",
            "end_time" => "required",
            "room" => "nullable|string|max:50",
        ]);
    }
}
