<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy("sort_order")->latest()->get();
        return view("admin.videos.index", compact("videos"));
    }

    public function create()
    {
        return view("admin.videos.form", ["video" => new Video()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Video::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan video: " . $data["title"]);
        return redirect()->route("admin.videos.index")->with("success", "Video berhasil disimpan.");
    }

    public function edit(Video $video)
    {
        return view("admin.videos.form", compact("video"));
    }

    public function update(Request $request, Video $video)
    {
        $video->update($this->validated($request));
        ActivityLog::log(auth()->user()->name . " memperbarui video: " . $video->title);
        return redirect()->route("admin.videos.index")->with("success", "Video berhasil diperbarui.");
    }

    public function destroy(Video $video)
    {
        $video->delete();
        ActivityLog::log(auth()->user()->name . " menghapus video: " . $video->title);
        return back()->with("success", "Video berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "title" => "required|string|max:200",
            "youtube_url" => "required|string|max:255",
            "description" => "nullable|string",
            "sort_order" => "nullable|integer",
        ]);
    }
}
