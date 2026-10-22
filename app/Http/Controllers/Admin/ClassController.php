<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Program;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::with(["program", "homeroomTeacher.user"])->withCount("students")->get();
        return view("admin.classes.index", compact("classes"));
    }

    public function create()
    {
        return view("admin.classes.form", [
            "schoolClass" => new SchoolClass(),
            "programs" => Program::all(),
            "teachers" => Teacher::with("user")->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        SchoolClass::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan kelas: " . $data["name"]);
        return redirect()->route("admin.classes.index")->with("success", "Kelas berhasil disimpan.");
    }

    public function edit(SchoolClass $class)
    {
        return view("admin.classes.form", [
            "schoolClass" => $class,
            "programs" => Program::all(),
            "teachers" => Teacher::with("user")->get(),
        ]);
    }

    public function update(Request $request, SchoolClass $class)
    {
        $class->update($this->validated($request));
        ActivityLog::log(auth()->user()->name . " memperbarui kelas: " . $class->name);
        return redirect()->route("admin.classes.index")->with("success", "Kelas berhasil diperbarui.");
    }

    public function destroy(SchoolClass $class)
    {
        $class->delete();
        return back()->with("success", "Kelas berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "name" => "required|string|max:100",
            "program_id" => "nullable|exists:programs,id",
            "grade" => "nullable|string|max:10",
            "homeroom_teacher_id" => "nullable|exists:teachers,id",
        ]);
    }
}
