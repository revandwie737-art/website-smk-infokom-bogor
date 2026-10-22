<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::orderByDesc("event_date")->paginate(9);
        return view("public.gallery.index", compact("galleries"));
    }

    public function show(string $slug)
    {
        $gallery = Gallery::where("slug", $slug)->with("images")->firstOrFail();
        return view("public.gallery.show", compact("gallery"));
    }
}
