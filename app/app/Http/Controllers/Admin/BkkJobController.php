<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\BkkJob;
use App\Models\Program;
use Illuminate\Http\Request;

class BkkJobController extends Controller
{
    public function index()
    {
        $jobs = BkkJob::with("program")->latest()->get();
        return view("admin.bkk-jobs.index", compact("jobs"));
    }

    public function create()
    {
        $programs = Program::orderBy("sort_order")->get();
        return view("admin.bkk-jobs.form", ["job" => new BkkJob(), "programs" => $programs]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $job = BkkJob::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan lowongan BKK: " . $job->position . " di " . $job->company_name);
        return redirect()->route("admin.bkk-jobs.index")->with("success", "Lowongan berhasil disimpan.");
    }

    public function edit(BkkJob $bkkJob)
    {
        $programs = Program::orderBy("sort_order")->get();
        return view("admin.bkk-jobs.form", ["job" => $bkkJob, "programs" => $programs]);
    }

    public function update(Request $request, BkkJob $bkkJob)
    {
        $bkkJob->update($this->validated($request));
        ActivityLog::log(auth()->user()->name . " memperbarui lowongan BKK: " . $bkkJob->position);
        return redirect()->route("admin.bkk-jobs.index")->with("success", "Lowongan berhasil diperbarui.");
    }

    public function destroy(BkkJob $bkkJob)
    {
        $bkkJob->delete();
        ActivityLog::log(auth()->user()->name . " menghapus lowongan BKK: " . $bkkJob->position);
        return back()->with("success", "Lowongan berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        $data = $request->validate([
            "company_name" => "required|string|max:150",
            "position" => "required|string|max:150",
            "location" => "nullable|string|max:150",
            "program_id" => "nullable|exists:programs,id",
            "qualifications" => "nullable|string",
            "job_type" => "required|in:penuh_waktu,paruh_waktu,magang,kontrak",
            "deadline" => "nullable|date",
            "description" => "nullable|string",
            "apply_link" => "nullable|url|max:255",
        ]);
        $data["is_active"] = $request->boolean("is_active");
        return $data;
    }
}
