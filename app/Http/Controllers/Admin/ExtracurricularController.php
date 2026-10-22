<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Extracurricular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $items = Extracurricular::latest()->get();
        return view("admin.extracurriculars.index", compact("items"));
    }

    public function create()
    {
        return view("admin.extracurriculars.form", ["item" => new Extracurricular()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) $data["logo"] = $request->file("logo")->store("extracurriculars", "public");
        if ($request->hasFile("background")) $data["background"] = $request->file("background")->store("extracurriculars", "public");
        Extracurricular::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan ekstrakurikuler: " . $data["name"]);
        return redirect()->route("admin.extracurriculars.index")->with("success", "Ekstrakurikuler berhasil disimpan.");
    }

    public function edit(Extracurricular $extracurricular)
    {
        return view("admin.extracurriculars.form", ["item" => $extracurricular]);
    }

    public function update(Request $request, Extracurricular $extracurricular)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            if ($extracurricular->logo) Storage::disk("public")->delete($extracurricular->logo);
            $data["logo"] = $request->file("logo")->store("extracurriculars", "public");
        }
        if ($request->hasFile("background")) {
            if ($extracurricular->background) Storage::disk("public")->delete($extracurricular->background);
            $data["background"] = $request->file("background")->store("extracurriculars", "public");
        }
        $extracurricular->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui ekstrakurikuler: " . $extracurricular->name);
        return redirect()->route("admin.extracurriculars.index")->with("success", "Ekstrakurikuler berhasil diperbarui.");
    }

    public function destroy(Extracurricular $extracurricular)
    {
        if ($extracurricular->logo) Storage::disk("public")->delete($extracurricular->logo);
        if ($extracurricular->background) Storage::disk("public")->delete($extracurricular->background);
        $extracurricular->delete();
        ActivityLog::log(auth()->user()->name . " menghapus ekstrakurikuler: " . $extracurricular->name);
        return back()->with("success", "Ekstrakurikuler berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "name" => "required|string|max:150",
            "logo" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "coach" => "nullable|string|max:150",
            "schedule" => "nullable|string|max:150",
            "description" => "nullable|string",
            "is_active" => "nullable|boolean",
        ]);
    }
}
