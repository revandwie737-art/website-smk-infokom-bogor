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
        if ($facility->supportsGallery()) {
            $extras = $facility->extra_photos ?? [];
            foreach ((array) $request->input("remove_extra", []) as $path) {
                if (in_array($path, $extras, true)) {
                    Storage::disk("public")->delete($path);
                    $extras = array_values(array_diff($extras, [$path]));
                }
            }
            if ($request->hasFile("extra_photos")) {
                foreach ($request->file("extra_photos") as $file) {
                    $extras[] = $file->store("facilities", "public");
                }
            }
            $data["extra_photos"] = array_values($extras);
        }
        $facility->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui fasilitas: " . $facility->name);
        return redirect()->route("admin.facilities.index")->with("success", "Fasilitas berhasil diperbarui.");
    }

    public function destroy(Facility $facility)
    {
        if ($facility->photo) Storage::disk("public")->delete($facility->photo);
        if ($facility->background) Storage::disk("public")->delete($facility->background);
        foreach (($facility->extra_photos ?? []) as $extra) Storage::disk("public")->delete($extra);
        $facility->delete();
        ActivityLog::log(auth()->user()->name . " menghapus fasilitas: " . $facility->name);
        return back()->with("success", "Fasilitas berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "extra_photos" => "nullable|array|max:12",
            "extra_photos.*" => "image|max:2048",
            "remove_extra" => "nullable|array",
            "remove_extra.*" => "string",
            "name" => "required|string|max:150",
            "photo" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "description" => "nullable|string",
            "quantity" => "nullable|integer",
            "sort_order" => "nullable|integer",
        ]);
        // Foto tambahan diproses terpisah (di update), bukan lewat mass assignment.
        unset($data["extra_photos"], $data["remove_extra"]);
        return $data;
    }
}