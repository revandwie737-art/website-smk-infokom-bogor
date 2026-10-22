<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::with("user")->latest()->paginate(15);
        return view("admin.teachers.index", compact("teachers"));
    }

    public function create()
    {
        return view("admin.teachers.form", ["teacher" => new Teacher()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8",
            "nip" => "nullable|string|max:30|unique:teachers,nip",
            "position" => "nullable|string|max:150",
            "phone" => "nullable|string|max:20",
            "photo" => "nullable|image|max:2048",
            "bio" => "nullable|string",
            "subjects" => "nullable|string",
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "role" => "teacher",
            "status" => "active",
        ]);

        $photoPath = $request->hasFile("photo") ? $request->file("photo")->store("teachers", "public") : null;

        Teacher::create([
            "user_id" => $user->id,
            "nip" => $data["nip"] ?? null,
            "position" => $data["position"] ?? null,
            "phone" => $data["phone"] ?? null,
            "photo" => $photoPath,
            "bio" => $data["bio"] ?? null,
            "subjects" => $data["subjects"] ?? null,
        ]);

        ActivityLog::log(auth()->user()->name . " menambahkan guru: " . $data["name"]);
        return redirect()->route("admin.teachers.index")->with("success", "Guru berhasil ditambahkan.");
    }

    public function edit(Teacher $teacher)
    {
        $teacher->load("user");
        return view("admin.teachers.form", compact("teacher"));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email," . $teacher->user_id,
            "nip" => "nullable|string|max:30|unique:teachers,nip," . $teacher->id,
            "position" => "nullable|string|max:150",
            "phone" => "nullable|string|max:20",
            "photo" => "nullable|image|max:2048",
            "bio" => "nullable|string",
            "subjects" => "nullable|string",
        ]);

        $teacher->user->update(["name" => $data["name"], "email" => $data["email"]]);

        if ($request->hasFile("photo")) {
            if ($teacher->photo) Storage::disk("public")->delete($teacher->photo);
            $data["photo"] = $request->file("photo")->store("teachers", "public");
        } else {
            unset($data["photo"]);
        }

        $teacher->update([
            "nip" => $data["nip"] ?? null,
            "position" => $data["position"] ?? null,
            "phone" => $data["phone"] ?? null,
            "photo" => $data["photo"] ?? $teacher->photo,
            "bio" => $data["bio"] ?? null,
            "subjects" => $data["subjects"] ?? null,
        ]);

        ActivityLog::log(auth()->user()->name . " memperbarui data guru: " . $data["name"]);
        return redirect()->route("admin.teachers.index")->with("success", "Data guru berhasil diperbarui.");
    }

    public function destroy(Teacher $teacher)
    {
        $name = $teacher->user->name;
        if ($teacher->photo) Storage::disk("public")->delete($teacher->photo);
        $teacher->user->delete();
        $teacher->delete();
        ActivityLog::log(auth()->user()->name . " menghapus guru: " . $name);
        return back()->with("success", "Guru berhasil dihapus.");
    }
}
