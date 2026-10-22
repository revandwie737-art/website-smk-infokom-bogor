<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Document;
use App\Models\SchoolSetting;

class AcademicController extends Controller
{
    public function index()
    {
        $documents = Document::where("is_public", true)->latest()->get();
        $announcements = Announcement::active()->latest()->take(5)->get();
        $achievements = Achievement::where("category", "akademik")->latest()->take(6)->get();

        $set = fn ($key, $default = null) => SchoolSetting::get($key, $default);

        return view("public.academic", compact("documents", "announcements", "achievements", "set"));
    }
}
