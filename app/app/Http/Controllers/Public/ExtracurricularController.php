<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Extracurricular;

class ExtracurricularController extends Controller
{
    public function index()
    {
        $items = Extracurricular::where("is_active", true)->get();
        return view("public.extracurricular", compact("items"));
    }
}
