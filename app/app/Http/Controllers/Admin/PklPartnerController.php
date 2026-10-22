<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\PklPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PklPartnerController extends Controller
{
    public function index()
    {
        $partners = PklPartner::orderBy("sort_order")->get();
        return view("admin.pkl-partners.index", compact("partners"));
    }

    public function create()
    {
        return view("admin.pkl-partners.form", ["partner" => new PklPartner()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("pkl", "public");
        }
        $partner = PklPartner::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan mitra PKL: " . $partner->name);
        return redirect()->route("admin.pkl-partners.index")->with("success", "Mitra PKL berhasil disimpan.");
    }

    public function edit(PklPartner $pklPartner)
    {
        return view("admin.pkl-partners.form", ["partner" => $pklPartner]);
    }

    public function update(Request $request, PklPartner $pklPartner)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            if ($pklPartner->logo) Storage::disk("public")->delete($pklPartner->logo);
            $data["logo"] = $request->file("logo")->store("pkl", "public");
        }
        $pklPartner->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui mitra PKL: " . $pklPartner->name);
        return redirect()->route("admin.pkl-partners.index")->with("success", "Mitra PKL berhasil diperbarui.");
    }

    public function destroy(PklPartner $pklPartner)
    {
        if ($pklPartner->logo) Storage::disk("public")->delete($pklPartner->logo);
        $pklPartner->delete();
        ActivityLog::log(auth()->user()->name . " menghapus mitra PKL: " . $pklPartner->name);
        return back()->with("success", "Mitra PKL berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "field" => "nullable|string|max:150",
            "address" => "nullable|string|max:255",
            "description" => "nullable|string",
            "logo" => "nullable|image|max:2048",
            "website" => "nullable|url|max:255",
            "sort_order" => "nullable|integer",
        ]);
        $data["is_active"] = $request->boolean("is_active");
        return $data;
    }
}
