<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom "background" (opsional) ke tabel-tabel yang kartunya
     * menampilkan foto utuh (object-contain) di halaman publik. Kolom ini
     * dipakai sebagai gambar latar (di-blur) di belakang foto utama supaya
     * tidak ada lagi ruang kosong berwarna polos di sekeliling foto ketika
     * rasio foto tidak sama dengan rasio kartu.
     *
     * Migration ini hanya menambah kolom baru (nullable), tidak mengubah
     * atau menghapus data yang sudah ada.
     */
    public function up(): void
    {
        foreach (['facilities', 'extracurriculars', 'galleries', 'programs', 'achievements'] as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (!Schema::hasColumn($table, 'background')) {
                    $blueprint->string('background')->nullable()->after(
                        Schema::hasColumn($table, 'photo') ? 'photo' : (
                            Schema::hasColumn($table, 'logo') ? 'logo' : (
                                Schema::hasColumn($table, 'cover') ? 'cover' : null
                            )
                        )
                    );
                }
            });
        }
    }

    public function down(): void
    {
        foreach (['facilities', 'extracurriculars', 'galleries', 'programs', 'achievements'] as $table) {
            Schema::table($table, function (Blueprint $blueprint) use ($table) {
                if (Schema::hasColumn($table, 'background')) {
                    $blueprint->dropColumn('background');
                }
            });
        }
    }
};
