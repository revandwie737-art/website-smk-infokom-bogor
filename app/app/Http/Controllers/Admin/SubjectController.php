<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::with("program")->get();
        return view("admin.subjects.index", compact("subjects"));
    }

    public function create()
    {
        return view("admin.subjects.form", ["subject" => new Subject(), "programs" => Program::all()]);
    }

    public function store(Request $request)
    {
        Subject::create($this->validated($request));
        return redirect()->route("admin.subjects.index")->with("success", "Mata pelajaran berhasil disimpan.");
    }

    public function edit(Subject $subject)
    {
        return view("admin.subjects.form", ["subject" => $subject, "programs" => Program::all()]);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($this->validated($request));
        return redirect()->route("admin.subjects.index")->with("success", "Mata pelajaran berhasil diperbarui.");
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with("success", "Mata pelajaran berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "name" => "required|string|max:150",
            "code" => "nullable|string|max:20",
            "program_id" => "nullable|exists:programs,id",
        ]);
    }
}
