<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->paginate(15);
        return view("admin.announcements.index", compact("announcements"));
    }

    public function create()
    {
        return view("admin.announcements.form", ["announcement" => new Announcement()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Announcement::create($data);
        ActivityLog::log(auth()->user()->name . " membuat pengumuman: " . $data["title"]);
        return redirect()->route("admin.announcements.index")->with("success", "Pengumuman berhasil disimpan.");
    }

    public function edit(Announcement $announcement)
    {
        return view("admin.announcements.form", compact("announcement"));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $announcement->update($this->validated($request));
        ActivityLog::log(auth()->user()->name . " memperbarui pengumuman: " . $announcement->title);
        return redirect()->route("admin.announcements.index")->with("success", "Pengumuman berhasil diperbarui.");
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        ActivityLog::log(auth()->user()->name . " menghapus pengumuman: " . $announcement->title);
        return back()->with("success", "Pengumuman berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "title" => "required|string|max:200",
            "content" => "required|string",
            "priority" => "required|in:low,normal,high",
            "is_active" => "nullable|boolean",
            "expires_at" => "nullable|date",
        ]);
    }
}
