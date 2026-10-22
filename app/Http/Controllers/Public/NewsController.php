<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->with("category")->latest("published_at");

        if ($request->filled("q")) {
            $query->where("title", "like", "%" . $request->q . "%");
        }
        if ($request->filled("category")) {
            $query->whereHas("category", fn ($q) => $q->where("slug", $request->category));
        }

        $news = $query->paginate(9)->withQueryString();
        $popular = News::published()->orderByDesc("views")->take(5)->get();
        $categories = Category::where("type", "news")->get();

        return view("public.news.index", compact("news", "popular", "categories"));
    }

    public function show(string $slug)
    {
        $article = News::published()->where("slug", $slug)->firstOrFail();
        $article->increment("views");
        $related = News::published()->where("id", "!=", $article->id)
            ->where("category_id", $article->category_id)->take(3)->get();

        return view("public.news.show", compact("article", "related"));
    }
}
