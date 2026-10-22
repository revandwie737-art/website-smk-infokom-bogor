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
            "birth_place" => "nullable|string|max:100",
            "birth_date" => "nullable|date",
            "gender" => "nullable|in:L,P",
            "email" => "required|email|max:150",
            "phone" => "required|string|max:20",
            "nisn" => "nullable|string|max:20",
            "previous_school" => "nullable|string|max:150",
            "program_id" => "required|exists:programs,id",
            "wave" => "required|in:gelombang_1,gelombang_2,gelombang_3",

            "address_street" => "nullable|string|max:200",
            "address_rt_rw" => "nullable|string|max:20",
            "address_village" => "nullable|string|max:100",
            "address_district" => "nullable|string|max:100",
            "address_city" => "nullable|string|max:100",
            "address_postal_code" => "nullable|string|max:10",

            "father_name" => "nullable|string|max:150",
            "father_job" => "nullable|string|max:100",
            "father_phone" => "nullable|string|max:20",
            "mother_name" => "nullable|string|max:150",
            "mother_job" => "nullable|string|max:100",
            "mother_phone" => "nullable|string|max:20",

            "guardian_name" => "nullable|string|max:150",
            "guardian_relation" => "nullable|string|max:100",
            "guardian_job" => "nullable|string|max:100",
            "guardian_phone" => "nullable|string|max:20",
            "guardian_address" => "nullable|string|max:255",

            "document_file" => "nullable|file|mimes:pdf,jpg,jpeg,png|max:2048",
        ]);

        if ($request->hasFile("document_file")) {
            $data["document_file"] = $request->file("document_file")->store("ppdb", "public");
        }

        PpdbRegistration::create($data);

        return back()->with("success", "Pendaftaran berhasil dikirim. Tim PPDB akan menghubungi Anda.");
    }
}
