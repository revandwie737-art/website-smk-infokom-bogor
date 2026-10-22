<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassMember;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClassMemberController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->get("class_id");
        $classes = SchoolClass::all();
        $members = $classId
            ? ClassMember::where("class_id", $classId)->orderBy("sort_order")->get()
            : collect();

        return view("admin.class-members.index", compact("classes", "members", "classId"));
    }

    public function create(Request $request)
    {
        return view("admin.class-members.form", [
            "member" => new ClassMember(),
            "classes" => SchoolClass::all(),
            "classId" => $request->get("class_id"),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            $data["photo"] = $request->file("photo")->store("class-members", "public");
        }
        ClassMember::create($data);

        return redirect()->route("admin.class-members.index", ["class_id" => $data["class_id"]])
            ->with("success", "Anggota kelas berhasil ditambahkan.");
    }

    public function edit(ClassMember $classMember)
    {
        return view("admin.class-members.form", [
            "member" => $classMember,
            "classes" => SchoolClass::all(),
            "classId" => $classMember->class_id,
        ]);
    }

    public function update(Request $request, ClassMember $classMember)
    {
        $data = $this->validated($request);
        if ($request->hasFile("photo")) {
            if ($classMember->photo) Storage::disk("public")->delete($classMember->photo);
            $data["photo"] = $request->file("photo")->store("class-members", "public");
        }
        $classMember->update($data);

        return redirect()->route("admin.class-members.index", ["class_id" => $data["class_id"]])
            ->with("success", "Anggota kelas berhasil diperbarui.");
    }

    public function destroy(ClassMember $classMember)
    {
        if ($classMember->photo) Storage::disk("public")->delete($classMember->photo);
        $classId = $classMember->class_id;
        $classMember->delete();

        return redirect()->route("admin.class-members.index", ["class_id" => $classId])
            ->with("success", "Anggota kelas berhasil dihapus.");
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "class_id" => "required|exists:classes,id",
            "name" => "required|string|max:150",
            "role" => "required|string|max:100",
            "photo" => "nullable|image|max:2048",
            "sort_order" => "nullable|integer",
        ]);
    }
}
