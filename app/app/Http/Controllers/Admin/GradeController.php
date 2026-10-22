<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AcademicYear;
use App\Models\Grade;
use App\Models\SchoolClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get("class_id");
        $subjectId = $request->get("subject_id");
        $classes = SchoolClass::all();
        $subjects = Subject::all();

        $students = collect();
        if ($classId) {
            $students = SchoolClass::find($classId)->students()->with("user")->get();
        }

        $grades = [];
        if ($classId && $subjectId) {
            $grades = Grade::where("subject_id", $subjectId)
                ->whereIn("student_id", $students->pluck("id"))
                ->get()->keyBy("student_id");
        }

        return view("admin.grades.index", compact("classes", "subjects", "students", "grades", "classId", "subjectId"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "subject_id" => "required|exists:subjects,id",
            "students" => "required|array",
            "students.*.student_id" => "required|exists:students,id",
            "students.*.tugas" => "nullable|numeric|min:0|max:100",
            "students.*.uts" => "nullable|numeric|min:0|max:100",
            "students.*.uas" => "nullable|numeric|min:0|max:100",
        ]);

        foreach ($data["students"] as $row) {
            Grade::updateOrCreate(
                ["student_id" => $row["student_id"], "subject_id" => $data["subject_id"], "academic_year_id" => null],
                ["tugas" => $row["tugas"] ?? null, "uts" => $row["uts"] ?? null, "uas" => $row["uas"] ?? null]
            );
        }

        return back()->with("success", "Nilai berhasil disimpan.");
    }
}
