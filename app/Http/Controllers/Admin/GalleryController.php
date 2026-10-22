<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Gallery;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::withCount("images")->orderByDesc("event_date")->get();
        return view("admin.gallery.index", compact("galleries"));
    }

    public function create()
    {
        return view("admin.gallery.form", ["gallery" => new Gallery()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|string|max:150",
            "category" => "nullable|string|max:100",
            "event_date" => "nullable|date",
            "cover" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "images.*" => "nullable|image|max:2048",
        ]);

        if ($request->hasFile("cover")) {
            $data["cover"] = $request->file("cover")->store("gallery", "public");
        }
        if ($request->hasFile("background")) {
            $data["background"] = $request->file("background")->store("gallery", "public");
        }

        $gallery = Gallery::create($data);

        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $i => $file) {
                GalleryImage::create([
                    "gallery_id" => $gallery->id,
                    "image" => $file->store("gallery", "public"),
                    "sort_order" => $i,
                ]);
            }
        }

        ActivityLog::log(auth()->user()->name . " membuat album galeri: " . $gallery->title);
        return redirect()->route("admin.gallery.index")->with("success", "Album galeri berhasil dibuat.");
    }

    public function edit(Gallery $gallery)
    {
        $gallery->load("images");
        return view("admin.gallery.form", compact("gallery"));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            "title" => "required|string|max:150",
            "category" => "nullable|string|max:100",
            "event_date" => "nullable|date",
            "cover" => "nullable|image|max:2048",
            "background" => "nullable|image|max:2048",
            "images.*" => "nullable|image|max:2048",
        ]);

        if ($request->hasFile("cover")) {
            if ($gallery->cover) Storage::disk("public")->delete($gallery->cover);
            $data["cover"] = $request->file("cover")->store("gallery", "public");
        }
        if ($request->hasFile("background")) {
            if ($gallery->background) Storage::disk("public")->delete($gallery->background);
            $data["background"] = $request->file("background")->store("gallery", "public");
        }

        $gallery->update($data);

        if ($request->hasFile("images")) {
            $maxOrder = $gallery->images()->max("sort_order") ?? 0;
            foreach ($request->file("images") as $i => $file) {
                GalleryImage::create([
                    "gallery_id" => $gallery->id,
                    "image" => $file->store("gallery", "public"),
                    "sort_order" => $maxOrder + $i + 1,
                ]);
            }
        }

        ActivityLog::log(auth()->user()->name . " memperbarui album galeri: " . $gallery->title);
        return redirect()->route("admin.gallery.index")->with("success", "Album galeri berhasil diperbarui.");
    }

    public function destroy(Gallery $gallery)
    {
        foreach ($gallery->images as $image) {
            Storage::disk("public")->delete($image->image);
        }
        if ($gallery->cover) Storage::disk("public")->delete($gallery->cover);
        if ($gallery->background) Storage::disk("public")->delete($gallery->background);
        $gallery->delete();
        ActivityLog::log(auth()->user()->name . " menghapus album galeri: " . $gallery->title);
        return back()->with("success", "Album galeri berhasil dihapus.");
    }

    public function destroyImage(GalleryImage $image)
    {
        Storage::disk("public")->delete($image->image);
        $galleryId = $image->gallery_id;
        $image->delete();
        return redirect()->route("admin.gallery.edit", $galleryId)->with("success", "Foto berhasil dihapus.");
    }
}
