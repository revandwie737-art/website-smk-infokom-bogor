<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Video;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy("sort_order")->latest()->paginate(9);
        return view("public.videos", compact("videos"));
    }
}
