<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BkkPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BkkPartnerController extends Controller
{
    public function index()
    {
        $partners = BkkPartner::orderBy("sort_order")->get();
        return view("admin.bkk-partners.index", compact("partners"));
    }

    public function create()
    {
        return view("admin.bkk-partners.form", ["partner" => new BkkPartner()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            $data["logo"] = $request->file("logo")->store("bkk", "public");
        }
        $partner = BkkPartner::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan mitra industri BKK: " . $partner->name);
        return redirect()->route("admin.bkk-partners.index")->with("success", "Mitra industri berhasil disimpan.");
    }

    public function edit(BkkPartner $bkkPartner)
    {
        return view("admin.bkk-partners.form", ["partner" => $bkkPartner]);
    }

    public function update(Request $request, BkkPartner $bkkPartner)
    {
        $data = $this->validated($request);
        if ($request->hasFile("logo")) {
            if ($bkkPartner->logo) Storage::disk("public")->delete($bkkPartner->logo);
            $data["logo"] = $request->file("logo")->store("bkk", "public");
        }
        $bkkPartner->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui mitra industri BKK: " . $bkkPartner->name);
        return redirect()->route("admin.bkk-partners.index")->with("success", "Mitra industri berhasil diperbarui.");
    }

    public function destroy(BkkPartner $bkkPartner)
    {
        if ($bkkPartner->logo) Storage::disk("public")->delete($bkkPartner->logo);
        $bkkPartner->delete();
        ActivityLog::log(auth()->user()->name . " menghapus mitra industri BKK: " . $bkkPartner->name);
        return back()->with("success", "Mitra industri berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "name" => "required|string|max:150",
            "description" => "nullable|string",
            "logo" => "nullable|image|max:2048",
            "website" => "nullable|url|max:255",
            "sort_order" => "nullable|integer",
        ]);
        return $data;
    }
}
