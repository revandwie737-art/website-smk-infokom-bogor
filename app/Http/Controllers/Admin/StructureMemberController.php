<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\StructureMember;
use Illuminate\Http\Request;

class StructureMemberController extends Controller
{
    public function index()
    {
        $members = StructureMember::orderBy("section")->orderBy("sort_order")->get()
            ->groupBy(fn ($m) => $m->section === "staff" ? "staff:" . ($m->group_label ?: "Tanpa Judul") : $m->section);
        return view("admin.structure.index", compact("members"));
    }

    public function create()
    {
        return view("admin.structure.form", ["member" => new StructureMember()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        StructureMember::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan anggota struktur organisasi: " . $data["name"]);
        return redirect()->route("admin.structure.index")->with("success", "Anggota struktur berhasil disimpan.");
    }

    public function edit(StructureMember $structure)
    {
        return view("admin.structure.form", ["member" => $structure]);
    }

    public function update(Request $request, StructureMember $structure)
    {
        $data = $this->validated($request);
        $structure->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui anggota struktur organisasi: " . $structure->name);
        return redirect()->route("admin.structure.index")->with("success", "Anggota struktur berhasil diperbarui.");
    }

    public function destroy(StructureMember $structure)
    {
        $structure->delete();
        ActivityLog::log(auth()->user()->name . " menghapus anggota struktur organisasi: " . $structure->name);
        return back()->with("success", "Anggota struktur berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "section" => "required|in:waka,inti,kaprog,staff",
            "group_label" => "nullable|string|max:100",
            "name" => "required|string|max:150",
            "role" => "nullable|string|max:150",
            "sort_order" => "nullable|integer",
        ]);
        if ($data["section"] !== "staff") {
            $data["group_label"] = null;
        }
        return $data;
    }
}