<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\PpdbRegistration;
use Illuminate\Http\Request;

class PpdbController extends Controller
{
    public function index(Request $request)
    {
        $query = PpdbRegistration::with("program")->latest();
        if ($request->filled("status")) {
            $query->where("status", $request->status);
        }
        $registrations = $query->paginate(15)->withQueryString();
        return view("admin.ppdb.index", compact("registrations"));
    }

    public function updateStatus(Request $request, PpdbRegistration $ppdbRegistration)
    {
        $request->validate(["status" => "required|in:pending,diterima,ditolak"]);
        $ppdbRegistration->update(["status" => $request->status]);
        ActivityLog::log(auth()->user()->name . " mengubah status pendaftar PPDB: " . $ppdbRegistration->full_name);
        return back()->with("success", "Status pendaftar berhasil diperbarui.");
    }

    public function destroy(PpdbRegistration $ppdbRegistration)
    {
        $ppdbRegistration->delete();
        return back()->with("success", "Data pendaftar berhasil dihapus.");
    }
}
