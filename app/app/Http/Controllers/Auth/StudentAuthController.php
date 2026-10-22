<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentAuthController extends Controller
{
    public function showLogin()
    {
        return view("auth.student-login");
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if (Auth::attempt($credentials, $request->boolean("remember"))) {
            $user = Auth::user();

            if ($user->role !== "student") {
                Auth::logout();
                return back()->withErrors(["email" => "Akun ini bukan akun siswa."]);
            }

            if ($user->status === "pending") {
                Auth::logout();
                return back()->withErrors(["email" => "Akun Anda masih menunggu persetujuan admin."]);
            }

            if ($user->status === "suspended") {
                Auth::logout();
                return back()->withErrors(["email" => "Akun Anda dinonaktifkan. Hubungi admin sekolah."]);
            }

            $request->session()->regenerate();
            return redirect()->intended(route("student.dashboard"));
        }

        return back()->withErrors(["email" => "Email atau password salah."])->onlyInput("email");
    }

    public function showRegister()
    {
        return view("auth.student-register");
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8|confirmed",
            "nisn" => "required|string|max:20|unique:students,nisn",
            "phone" => "required|string|max:20",
            "birth_date" => "required|date",
            "address" => "required|string",
        ]);

        $user = User::create([
            "name" => $data["name"],
            "email" => $data["email"],
            "password" => Hash::make($data["password"]),
            "role" => "student",
            "status" => "pending",
        ]);

        Student::create([
            "user_id" => $user->id,
            "nisn" => $data["nisn"],
            "phone" => $data["phone"],
            "birth_date" => $data["birth_date"],
            "address" => $data["address"],
        ]);

        return redirect()->route("student.login")
            ->with("success", "Pendaftaran berhasil! Akun Anda menunggu persetujuan admin sebelum dapat login.");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route("student.login");
    }
}
