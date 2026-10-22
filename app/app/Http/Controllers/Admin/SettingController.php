<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\SchoolSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected array $keys = [
        "site_name", "site_logo", "site_favicon", "site_description",
        "hero_title", "hero_subtitle", "hero_image", "about_image",
        "about_text", "vision", "mission",
        "principal_name", "principal_position", "principal_photo", "principal_message",
        "phone", "email", "address", "facebook", "instagram", "youtube", "whatsapp",
        "jam_operasional", "google_maps_url", "footer_copyright",
        "ppdb_fee_wave1", "ppdb_fee_wave2", "ppdb_official_link",
        "akreditasi", "jumlah_guru", "siswa_laki", "siswa_perempuan",
        "rombel", "ruang_kelas", "laboratorium", "perpustakaan",
        "pkl_about", "pkl_purpose", "pkl_benefits", "pkl_hero_image",
        "bkk_manager_name", "bkk_whatsapp", "bkk_email", "bkk_hours",
        "bkk_stat_alumni", "bkk_stat_programs", "bkk_intro",
        "seo_title", "seo_description",
        "show_hero", "show_news", "show_achievements", "show_gallery", "show_announcement",
    ];

    public function index()
    {
        $settings = SchoolSetting::pluck("value", "key");
        return view("admin.settings.index", compact("settings"));
    }

    public function update(Request $request)
    {
        foreach ($this->keys as $key) {
            if ($request->hasFile($key)) {
                $path = $request->file($key)->store("settings", "public");
                SchoolSetting::set($key, $path);
            } elseif ($request->has($key)) {
                SchoolSetting::set($key, $request->input($key));
            }
        }

        ActivityLog::log(auth()->user()->name . " memperbarui pengaturan website");

        return back()->with("success", "Pengaturan berhasil disimpan.");
    }
}
