<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\News;
use App\Models\PklPartner;
use App\Models\SchoolSetting;

class PklController extends Controller
{
    public function index()
    {
        $partners = PklPartner::where("is_active", true)->orderBy("sort_order")->get();

        $fields = $partners->pluck("field")->filter()->unique()->values();

        $galleries = Gallery::where("category", "PKL")->orderByDesc("event_date")->take(6)->get();

        $news = News::published()->with("category")
            ->whereHas("category", fn ($q) => $q->where("slug", "pkl"))
            ->latest("published_at")->take(3)->get();

        $content = [
            "hero_image" => SchoolSetting::get("pkl_hero_image"),
            "about" => SchoolSetting::get("pkl_about"),
            "purpose" => SchoolSetting::get("pkl_purpose"),
            "benefits" => SchoolSetting::get("pkl_benefits"),
        ];

        return view("public.pkl.index", compact("partners", "fields", "galleries", "news", "content"));
    }
}
