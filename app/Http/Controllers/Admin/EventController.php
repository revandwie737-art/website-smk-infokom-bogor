<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy("event_date")->paginate(15);
        return view("admin.events.index", compact("events"));
    }

    public function create()
    {
        return view("admin.events.form", ["event" => new Event()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        Event::create($data);
        ActivityLog::log(auth()->user()->name . " membuat agenda: " . $data["title"]);
        return redirect()->route("admin.events.index")->with("success", "Agenda berhasil disimpan.");
    }

    public function edit(Event $event)
    {
        return view("admin.events.form", compact("event"));
    }

    public function update(Request $request, Event $event)
    {
        $event->update($this->validated($request));
        ActivityLog::log(auth()->user()->name . " memperbarui agenda: " . $event->title);
        return redirect()->route("admin.events.index")->with("success", "Agenda berhasil diperbarui.");
    }

    public function destroy(Event $event)
    {
        $event->delete();
        ActivityLog::log(auth()->user()->name . " menghapus agenda: " . $event->title);
        return back()->with("success", "Agenda berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "title" => "required|string|max:200",
            "category" => "required|in:umum,bkk",
            "event_date" => "required|date",
            "event_time" => "nullable",
            "location" => "nullable|string|max:200",
            "description" => "nullable|string",
        ]);
    }
}
