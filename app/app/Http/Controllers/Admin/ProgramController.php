<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::orderBy("sort_order")->get();
        return view("admin.programs.index", compact("programs"));
    }

    public function create()
    {
        return view("admin.programs.form", ["program" => new Program()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            $data["photo"] = $request->file("photo")->store("programs", "public");
        }
        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("programs/logos", "public");
        }
        if ($request->hasFile("background")) {
            $data["background"] = $request->file("background")->store("programs", "public");
        }
        $program = Program::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan program keahlian: " . $program->name);
        return redirect()->route("admin.programs.index")->with("success", "Program keahlian berhasil disimpan.");
    }

    public function edit(Program $program)
    {
        return view("admin.programs.form", compact("program"));
    }

    public function update(Request $request, Program $program)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            if ($program->photo) Storage::disk("public")->delete($program->photo);
            $data["photo"] = $request->file("photo")->store("programs", "public");
        }
        if ($request->hasFile("logo")) {
            if ($program->logo) Storage::disk("public")->delete($program->logo);
            $data["logo"] = $request->file("logo")->store("programs/logos", "public");
        }
        if ($request->hasFile("background")) {
            if ($program->background) Storage::disk("public")->delete($program->background);
            $data["background"] = $request->file("background")->store("programs", "public");
        }
        $program->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui program keahlian: " . $program->name);
        return redirect()->route("admin.programs.index")->with("success", "Program keahlian berhasil diperbarui.");
    }

    public function destroy(Program $program)
    {
        if ($program->photo) Storage::disk("public")->delete($program->photo);
        if ($program->background) Storage::disk("public")->delete($program->background);
        $program->delete();
        ActivityLog::log(auth()->user()->name . " menghapus program keahlian: " . $program->name);
        return back()->with("success", "Program keahlian berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "name" => "required|string|max:150",
            "code" => "required|string|max:20",
            "photo" => "nullable|image|max:2048",
            "logo" => "nullable|image|max:5120",
            "background" => "nullable|image|max:2048",
            "description" => "nullable|string",
            "competencies" => "nullable|string",
            "prospects" => "nullable|string",
            "facilities" => "nullable|string",
            "subjects" => "nullable|string",
            "sort_order" => "nullable|integer",
            "is_active" => "nullable|boolean",
        ]);
    }
}
