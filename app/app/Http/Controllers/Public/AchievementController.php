<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index(Request $request)
    {
        $query = Achievement::latest("year");
        if ($request->filled("category")) {
            $query->where("category", $request->category);
        }
        $achievements = $query->paginate(9)->withQueryString();
        return view("public.achievements", compact("achievements"));
    }
}
