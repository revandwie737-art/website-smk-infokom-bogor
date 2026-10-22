<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\IndustrialVisit;

class IndustrialVisitController extends Controller
{
    public function index()
    {
        $visits = IndustrialVisit::published()->with('photos')
            ->orderByDesc('visit_date')->orderByDesc('id')->paginate(9);

        return view('public.industrial-visits.index', compact('visits'));
    }

    public function show(string $slug)
    {
        $visit = IndustrialVisit::published()->with('photos')->where('slug', $slug)->firstOrFail();

        $others = IndustrialVisit::published()->with('photos')
            ->where('id', '!=', $visit->id)
            ->orderByDesc('visit_date')->orderByDesc('id')->limit(3)->get();

        return view('public.industrial-visits.show', compact('visit', 'others'));
    }
}