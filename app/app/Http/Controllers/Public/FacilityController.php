<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Facility;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy("sort_order")->get();
        return view("public.facilities", compact("facilities"));
    }
}
