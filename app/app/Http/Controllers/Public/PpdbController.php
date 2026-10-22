<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\PpdbRegistration;
use App\Models\Program;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index()
    {
        $programs = Program::where("is_active", true)->get();
        return view("public.ppdb", compact("programs"));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "full_name" => "required|string|max:150",
            "email" => "required|email|max:150",
            "phone" => "required|string|max:20",
            "nisn" => "nullable|string|max:20",
            "previous_school" => "nullable|string|max:150",
            "program_id" => "required|exists:programs,id",
            "wave" => "required|in:gelombang_1,gelombang_2",
            "address" => "nullable|string",
            "document_file" => "nullable|file|mimes:pdf,jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile("document_file")) {
            $data["document_file"] = $request->file("document_file")->store("ppdb", "public");
        }

        PpdbRegistration::create($data);

        return back()->with("success", "Pendaftaran berhasil dikirim. Tim PPDB akan menghubungi Anda.");
    }
}
