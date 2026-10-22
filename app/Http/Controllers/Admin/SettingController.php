<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = SchoolSetting::pluck('value', 'key')->toArray();

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        // Field teks
        foreach ($request->except(['_token', '_method']) as $key => $value) {
            if ($request->hasFile($key) || is_array($value)) {
                continue;
            }
            SchoolSetting::updateOrCreate(['key' => $key], ['value' => $value ?? '']);
        }

        // Field file (logo, favicon, foto hero, dll.)
        foreach ($request->allFiles() as $key => $file) {
            if (! $file->isValid()) {
                continue;
            }
            $path = $file->store('settings', 'public');
            SchoolSetting::updateOrCreate(['key' => $key], ['value' => $path]);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}