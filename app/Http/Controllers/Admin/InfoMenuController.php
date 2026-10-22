<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\InfoMenuItem;
use Illuminate\Http\Request;

class InfoMenuController extends Controller
{
    public function index()
    {
        $items = InfoMenuItem::orderBy("sort_order")->get();
        return view("admin.info-menu.index", compact("items"));
    }

    public function create()
    {
        return view("admin.info-menu.form", ["item" => new InfoMenuItem()]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data["sort_order"] = (int) (InfoMenuItem::max("sort_order") ?? 0) + 1;
        $data["is_active"] = $request->boolean("is_active", true);
        InfoMenuItem::create($data);
        ActivityLog::log(auth()->user()->name . " menambahkan menu Informasi: " . $data["label"]);
        return redirect()->route("admin.info-menu.index")->with("success", "Menu berhasil ditambahkan.");
    }

    public function edit(InfoMenuItem $infoMenu)
    {
        return view("admin.info-menu.form", ["item" => $infoMenu]);
    }

    public function update(Request $request, InfoMenuItem $infoMenu)
    {
        $data = $this->validated($request);
        $data["is_active"] = $request->boolean("is_active", true);
        $infoMenu->update($data);
        ActivityLog::log(auth()->user()->name . " memperbarui menu Informasi: " . $infoMenu->label);
        return redirect()->route("admin.info-menu.index")->with("success", "Menu berhasil diperbarui.");
    }

    public function destroy(InfoMenuItem $infoMenu)
    {
        $infoMenu->delete();
        ActivityLog::log(auth()->user()->name . " menghapus menu Informasi: " . $infoMenu->label);
        return back()->with("success", "Menu berhasil dihapus.");
    }

    public function move(Request $request, InfoMenuItem $infoMenu)
    {
        $direction = $request->input("direction");
        $neighbor = $direction === "up"
            ? InfoMenuItem::where("sort_order", "<", $infoMenu->sort_order)->orderByDesc("sort_order")->first()
            : InfoMenuItem::where("sort_order", ">", $infoMenu->sort_order)->orderBy("sort_order")->first();

        if ($neighbor) {
            [$a, $b] = [$infoMenu->sort_order, $neighbor->sort_order];
            $infoMenu->update(["sort_order" => $b]);
            $neighbor->update(["sort_order" => $a]);
        }

        return back();
    }

    protected function validated(Request $request): array
    {
        return $request->validate([
            "icon" => "nullable|string|max:10",
            "label" => "required|string|max:80",
            "description" => "nullable|string|max:150",
            "url" => "required|string|max:255",
        ]);
    }
}