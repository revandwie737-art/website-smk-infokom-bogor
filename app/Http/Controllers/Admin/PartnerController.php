<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy("type")->orderBy("sort_order")->get();
        return view("admin.partners.index", compact("partners"));
    }

    public function create()
    {
        return view("admin.partners.form", ["partner" => new Partner()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("partners", "public");
        }
        $partner = Partner::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan mitra kerjasama: " . $partner->name);
        return redirect()->route("admin.partners.index")->with("success", "Mitra kerjasama berhasil disimpan.");
    }

    public function edit(Partner $partner)
    {
        return view("admin.partners.form", compact("partner"));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            if ($partner->logo) Storage::disk("public")->delete($partner->logo);
            $data["logo"] = $request->file("logo")->store("partners", "public");
        }
        $partner->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui mitra kerjasama: " . $partner->name);
        return redirect()->route("admin.partners.index")->with("success", "Mitra kerjasama berhasil diperbarui.");
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo) Storage::disk("public")->delete($partner->logo);
        $partner->delete();
        ActivityLog::log(auth()->user()->name . " menghapus mitra kerjasama: " . $partner->name);
        return back()->with("success", "Mitra kerjasama berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "type" => "required|in:universitas,industri",
            "logo" => "nullable|image|max:2048",
            "website" => "nullable|url|max:255",
            "sort_order" => "nullable|integer",
        ]);
        return $data;
    }
}
