<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::latest()->get();
        return view("admin.documents.index", compact("documents"));
    }

    public function create()
    {
        return view("admin.documents.form", ["document" => new Document()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "title" => "required|string|max:200",
            "category" => "nullable|string|max:100",
            "file" => "required|file|max:10240",
        ]);
        $data["file"] = $request->file("file")->store("documents", "public");
        $data["is_public"] = $request->boolean("is_public", true);

        $document = Document::create($data);
        ActivityLog::log(auth()->user()->name . " mengunggah dokumen: " . $document->title);
        return redirect()->route("admin.documents.index")->with("success", "Dokumen berhasil diunggah.");
    }

    public function edit(Document $document)
    {
        return view("admin.documents.form", compact("document"));
    }

    public function update(Request $request, Document $document)
    {
        $data = $request->validate([
            "title" => "required|string|max:200",
            "category" => "nullable|string|max:100",
            "file" => "nullable|file|max:10240",
        ]);
        if ($request->hasFile("file")) {
            Storage::disk("public")->delete($document->file);
            $data["file"] = $request->file("file")->store("documents", "public");
        }
        $data["is_public"] = $request->boolean("is_public", true);

        $document->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui dokumen: " . $document->title);
        return redirect()->route("admin.documents.index")->with("success", "Dokumen berhasil diperbarui.");
    }

    public function destroy(Document $document)
    {
        Storage::disk("public")->delete($document->file);
        $document->delete();
        ActivityLog::log(auth()->user()->name . " menghapus dokumen: " . $document->title);
        return back()->with("success", "Dokumen berhasil dihapus.");
    }
}
