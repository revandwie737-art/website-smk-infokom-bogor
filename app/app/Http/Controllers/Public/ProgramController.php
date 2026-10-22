<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Program;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::where("is_active", true)->orderBy("sort_order")->get();
        return view("public.programs.index", compact("programs"));
    }

    public function show(string $slug)
    {
        $program = Program::where("slug", $slug)->where("is_active", true)->firstOrFail();
        $related = Program::where("is_active", true)->where("id", "!=", $program->id)->take(3)->get();
        return view("public.programs.show", compact("program", "related"));
    }
}
