<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\BkkJob;
use App\Models\BkkPartner;
use App\Models\Event;
use App\Models\Program;
use App\Models\SchoolSetting;

class BkkController extends Controller
{
    public function index()
    {
        $jobs = BkkJob::with("program")->where("is_active", true)
            ->orderByRaw("deadline IS NULL, deadline asc")
            ->get();

        $partners = BkkPartner::orderBy("sort_order")->get();
        $programs = Program::orderBy("sort_order")->get();

        $agenda = Event::where("category", "bkk")
            ->where("event_date", ">=", now()->subDays(1))
            ->orderBy("event_date")->take(6)->get();

        $set = fn ($key, $default = null) => SchoolSetting::get($key, $default);

        return view("public.bkk.index", compact("jobs", "partners", "programs", "agenda", "set"));
    }
}
