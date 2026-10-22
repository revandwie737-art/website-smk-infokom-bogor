<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Event;

class AgendaController extends Controller
{
    public function index()
    {
        $events = Event::where("event_date", ">=", now()->subDays(1))->orderBy("event_date")->get();
        return view("public.agenda", compact("events"));
    }
}
