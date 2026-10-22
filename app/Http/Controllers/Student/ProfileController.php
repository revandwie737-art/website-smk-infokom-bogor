<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $student = Auth::user()->student;
        return view("student.profile", compact("student"));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $student = $user->student;

        $data = $request->validate([
            "name" => "required|string|max:150",
            "phone" => "nullable|string|max:20",
            "address" => "nullable|string",
            "photo" => "nullable|image|max:2048",
        ]);

        $user->update(["name" => $data["name"]]);

        if ($request->hasFile("photo")) {
            if ($student->photo) Storage::disk("public")->delete($student->photo);
            $student->photo = $request->file("photo")->store("students", "public");
        }
        $student->phone = $data["phone"] ?? $student->phone;
        $student->address = $data["address"] ?? $student->address;
        $student->save();

        return back()->with("success", "Profil berhasil diperbarui.");
    }

    public function updatePassword(Request $request)
    {
        $data = $request->validate([
            "current_password" => "required",
            "password" => "required|min:8|confirmed",
        ]);

        $user = Auth::user();
        if (! Hash::check($data["current_password"], $user->password)) {
            return back()->withErrors(["current_password" => "Password lama salah."]);
        }

        $user->update(["password" => Hash::make($data["password"])]);
        return back()->with("success", "Password berhasil diubah.");
    }
}
