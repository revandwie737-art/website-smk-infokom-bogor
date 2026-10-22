<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with("category")->latest();
        if ($request->filled("q")) {
            $query->where("title", "like", "%" . $request->q . "%");
        }
        $news = $query->paginate(15)->withQueryString();
        return view("admin.news.index", compact("news"));
    }

    public function create()
    {
        $categories = Category::where("type", "news")->get();
        return view("admin.news.form", ["news" => new News(), "categories" => $categories]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile("thumbnail")) {
            $data["thumbnail"] = $request->file("thumbnail")->store("news", "public");
        }
        $data["author_id"] = auth()->id();
        if ($data["status"] === "published" && empty($data["published_at"])) {
            $data["published_at"] = now();
        }

        $news = News::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan berita: " . $news->title);

        return redirect()->route("admin.news.index")->with("success", "Berita berhasil disimpan.");
    }

    public function edit(News $news)
    {
        $categories = Category::where("type", "news")->get();
        return view("admin.news.form", compact("news", "categories"));
    }

    public function update(Request $request, News $news)
    {
        $data = $this->validated($request, $news->id);

        if ($request->hasFile("thumbnail")) {
            if ($news->thumbnail) Storage::disk("public")->delete($news->thumbnail);
            $data["thumbnail"] = $request->file("thumbnail")->store("news", "public");
        }
        if ($data["status"] === "published" && empty($news->published_at) && empty($data["published_at"])) {
            $data["published_at"] = now();
        }

        $news->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui berita: " . $news->title);

        return redirect()->route("admin.news.index")->with("success", "Berita berhasil diperbarui.");
    }

    public function destroy(News $news)
    {
        if ($news->thumbnail) Storage::disk("public")->delete($news->thumbnail);
        $news->delete();
        ActivityLog::log(auth()->user()->name . " menghapus berita: " . $news->title);

        return back()->with("success", "Berita berhasil dihapus.");
    }

    protected function validated(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            "title" => "required|string|max:200",
            "category_id" => "nullable|exists:categories,id",
            "thumbnail" => "nullable|image|max:2048",
            "excerpt" => "nullable|string|max:500",
            "content" => "required|string",
            "status" => "required|in:draft,published",
            "published_at" => "nullable|date",
            "instagram_url" => "nullable|url|max:255",
            "seo_title" => "nullable|string|max:200",
            "seo_description" => "nullable|string|max:300",
        ]);
    }
}
