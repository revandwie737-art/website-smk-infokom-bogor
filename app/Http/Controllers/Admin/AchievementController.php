<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    public function index()
    {
        $achievements = Achievement::latest("year")->paginate(15);
        return view("admin.achievements.index", compact("achievements"));
    }

    public function create()
    {
        return view("admin.achievements.form", ["achievement" => new Achievement()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) $data["photo"] = $request->file("photo")->store("achievements", "public");
        if ($request->hasFile("background")) $data["background"] = $request->file("background")->store("achievements", "public");
        if ($request->hasFile("certificate")) $data["certificate"] = $request->file("certificate")->store("achievements/certificates", "public");
        Achievement::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan prestasi: " . $data["title"]);
        return redirect()->route("admin.achievements.index")->with("success", "Prestasi berhasil disimpan.");
    }

    public function edit(Achievement $achievement)
    {
        return view("admin.achievements.form", compact("achievement"));
    }

    public function update(Request $request, Achievement $achievement)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            if ($achievement->photo) Storage::disk("public")->delete($achievement->photo);
            $data["photo"] = $request->file("photo")->store("achievements", "public");
        }
        if ($request->hasFile("background")) {
            if ($achievement->background) Storage::disk("public")->delete($achievement->background);
            $data["background"] = $request->file("background")->store("achievements", "public");
        }
        if ($request->hasFile("certificate")) {
            if ($achievement->certificate) Storage::disk("public")->delete($achievement->certificate);
            $data["certificate"] = $request->file("certificate")->store("achievements/certificates", "public");
        }
        $achievement->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui prestasi: " . $achievement->title);
        return redirect()->route("admin.achievements.index")->with("success", "Prestasi berhasil diperbarui.");
    }

    public function destroy(Achievement $achievement)
    {
        if ($achievement->photo) Storage::disk("public")->delete($achievement->photo);
        if ($achievement->background) Storage::disk("public")->delete($achievement->background);
        if ($achievement->certificate) Storage::disk("public")->delete($achievement->certificate);
        $achievement->delete();
        ActivityLog::log(auth()->user()->name . " menghapus prestasi: " . $achievement->title);
        return back()->with("success", "Prestasi berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "title" => "required|string|max:200",
            "student_name" => "nullable|string|max:150",
            "category" => "required|in:akademik,olahraga,seni,teknologi,lainnya",
            "level" => "required|in:sekolah,kabupaten_kota,provinsi,nasional,internasional",
            "year" => "required|digits:4",
            "description" => "nullable|string",
            "photo" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "certificate" => "nullable|file|mimes:pdf,jpg,jpeg,png|max:2048",
            "link" => "nullable|url|max:255",
        ]);
    }
}
