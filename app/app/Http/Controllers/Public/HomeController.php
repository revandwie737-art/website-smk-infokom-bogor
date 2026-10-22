<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\News;
use App\Models\Partner;
use App\Models\Program;
use App\Models\SchoolSetting;

class HomeController extends Controller
{
    public function index()
    {
        $programs = Program::where("is_active", true)->orderBy("sort_order")->get();
        $latestNews = News::published()->latest("published_at")->take(3)->get();
        $achievements = Achievement::latest()->take(4)->get();
        $galleries = Gallery::orderByDesc("event_date")->take(6)->get();
        $announcements = Announcement::active()->latest()->take(5)->get();
        $partners = Partner::orderBy("type")->orderBy("sort_order")->get();

        return view("public.home", compact(
            "programs", "latestNews", "achievements", "galleries", "announcements", "partners"
        ));
    }
}
