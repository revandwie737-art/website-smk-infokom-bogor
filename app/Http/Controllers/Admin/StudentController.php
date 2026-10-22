<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with(["user", "schoolClass"]);
        if ($request->filled("q")) {
            $query->whereHas("user", fn ($q) => $q->where("name", "like", "%" . $request->q . "%"))
                ->orWhere("nisn", "like", "%" . $request->q . "%");
        }
        if ($request->filled("status")) {
            $query->whereHas("user", fn ($q) => $q->where("status", $request->status));
        }
        $students = $query->latest()->paginate(15)->withQueryString();
        return view("admin.students.index", compact("students"));
    }

    public function create()
    {
        $classes = SchoolClass::all();
        return view("admin.students.form", ["student" => new Student(), "classes" => $classes]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
            "nisn" => "required|string|max:20|unique:students,nisn",
            "class_id" => "nullable|exists:classes,id",
            "phone" => "nullable|string|max:20",
            "birth_date" => "nullable|date",
            "address" => "nullable|string",
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "role" => "student",
            "status" => "active",
        ]);

        Student::create([
            "user_id" => $user->id,
            "class_id" => $data["class_id"] ?? null,
            "nisn" => $data["nisn"],
            "phone" => $data["phone"] ?? null,
            "birth_date" => $data["birth_date"] ?? null,
            "address" => $data["address"] ?? null,
        ]);

        ActivityLog::log(auth()->user()->name . " menambahkan siswa: " . $data["name"]);
        return redirect()->route("admin.students.index")->with("success", "Siswa berhasil ditambahkan.");
    }

    public function edit(Student $student)
    {
        $student->load("user");
        $classes = SchoolClass::all();
        return view("admin.students.form", compact("student", "classes"));
    }

    public function update(Request $request, Student $student)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email," . $student->user_id,
            "class_id" => "nullable|exists:classes,id",
            "phone" => "nullable|string|max:20",
            "birth_date" => "nullable|date",
            "address" => "nullable|string",
        ]);

        $student->user->update(["name" => $data["name"], "email" => $data["email"]]);
        $student->update([
            "class_id" => $data["class_id"] ?? null,
            "phone" => $data["phone"] ?? null,
            "birth_date" => $data["birth_date"] ?? null,
            "address" => $data["address"] ?? null,
        ]);

        ActivityLog::log(auth()->user()->name . " memperbarui data siswa: " . $data["name"]);
        return redirect()->route("admin.students.index")->with("success", "Data siswa berhasil diperbarui.");
    }

    public function approve(Student $student)
    {
        $student->user->update(["status" => "active"]);
        ActivityLog::log(auth()->user()->name . " menyetujui akun siswa: " . $student->user->name);
        return back()->with("success", "Akun siswa telah disetujui.");
    }

    public function suspend(Student $student)
    {
        $student->user->update(["status" => "suspended"]);
        ActivityLog::log(auth()->user()->name . " menonaktifkan akun siswa: " . $student->user->name);
        return back()->with("success", "Akun siswa telah dinonaktifkan.");
    }

    public function destroy(Student $student)
    {
        $name = $student->user->name;
        $student->user->delete();
        $student->delete();
        ActivityLog::log(auth()->user()->name . " menghapus siswa: " . $name);
        return back()->with("success", "Siswa berhasil dihapus.");
    }
}
