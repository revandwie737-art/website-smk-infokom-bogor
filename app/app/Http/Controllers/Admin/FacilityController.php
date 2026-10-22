<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy("sort_order")->get();
        return view("admin.facilities.index", compact("facilities"));
    }

    public function create()
    {
        return view("admin.facilities.form", ["facility" => new Facility()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) $data["photo"] = $request->file("photo")->store("facilities", "public");
        if ($request->hasFile("background")) $data["background"] = $request->file("background")->store("facilities", "public");
        Facility::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan fasilitas: " . $data["name"]);
        return redirect()->route("admin.facilities.index")->with("success", "Fasilitas berhasil disimpan.");
    }

    public function edit(Facility $facility)
    {
        return view("admin.facilities.form", compact("facility"));
    }

    public function update(Request $request, Facility $facility)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            if ($facility->photo) Storage::disk("public")->delete($facility->photo);
            $data["photo"] = $request->file("photo")->store("facilities", "public");
        }
        if ($request->hasFile("background")) {
            if ($facility->background) Storage::disk("public")->delete($facility->background);
            $data["background"] = $request->file("background")->store("facilities", "public");
        }
        $facility->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui fasilitas: " . $facility->name);
        return redirect()->route("admin.facilities.index")->with("success", "Fasilitas berhasil diperbarui.");
    }

    public function destroy(Facility $facility)
    {
        if ($facility->photo) Storage::disk("public")->delete($facility->photo);
        if ($facility->background) Storage::disk("public")->delete($facility->background);
        $facility->delete();
        ActivityLog::log(auth()->user()->name . " menghapus fasilitas: " . $facility->name);
        return back()->with("success", "Fasilitas berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "name" => "required|string|max:150",
            "photo" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "description" => "nullable|string",
            "quantity" => "nullable|integer",
            "sort_order" => "nullable|integer",
        ]);
    }
}
