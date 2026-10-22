<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("info_menu_items", function (Blueprint $table) {
            $table->id();
            $table->string("icon")->default("🔗");
            $table->string("label");
            $table->string("description")->nullable();
            $table->string("url");
            $table->integer("sort_order")->default(0);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });

        // Seed with the menu items that already exist today, so nothing changes on the site until edited.
        $now = now();
        DB::table("info_menu_items")->insert([
            ["icon" => "🎓", "label" => "Data Guru",       "description" => "Profil tenaga pendidik",           "url" => "/guru",           "sort_order" => 1, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🏆", "label" => "Prestasi",        "description" => "Capaian & penghargaan siswa",      "url" => "/prestasi",       "sort_order" => 2, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🖼️", "label" => "Galeri",          "description" => "Momen kegiatan sekolah",           "url" => "/galeri",         "sort_order" => 3, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🎬", "label" => "Video",           "description" => "Dokumentasi audio visual",         "url" => "/video",          "sort_order" => 4, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🎯", "label" => "Ekstrakurikuler", "description" => "Kembangkan minat & bakat",         "url" => "/ekstrakurikuler","sort_order" => 5, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🏫", "label" => "Fasilitas",       "description" => "Sarana penunjang belajar",         "url" => "/fasilitas",      "sort_order" => 6, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🛠️", "label" => "PKL",             "description" => "Praktik kerja lapangan",           "url" => "/pkl",            "sort_order" => 7, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "💼", "label" => "BKK",             "description" => "Bursa kerja khusus",               "url" => "/bkk",            "sort_order" => 8, "is_active" => true, "created_at" => $now, "updated_at" => $now],
            ["icon" => "🗓️", "label" => "Agenda",          "description" => "Jadwal kegiatan sekolah",          "url" => "/agenda",         "sort_order" => 9, "is_active" => true, "created_at" => $now, "updated_at" => $now],
        ]);
    }
    public function down(): void { Schema::dropIfExists("info_menu_items"); }
};