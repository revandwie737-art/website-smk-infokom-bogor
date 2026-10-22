<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Teks halaman (intro, program khusus alumni, penutup)
        Schema::create('japan_internship_texts', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title')->nullable();
            $table->text('body')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Catatan tambahan di jalur "Perjalanan Magang Jepang"
        Schema::create('japan_internship_steps', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();   // label waktu opsional, diisi bebas oleh admin
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // "Pengalaman yang Didapat"
        Schema::create('japan_internship_experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Isi awal HANYA dari keterangan resmi pemilik website (program khusus alumni, dokumentasi perjalanan).
        $now = now();
        DB::table('japan_internship_texts')->insert([
            [
                'slug' => 'intro',
                'title' => null,
                'body' => 'Dokumentasi perjalanan alumni SMK Infokom Bogor menuju Jepang.',
                'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'slug' => 'alumni',
                'title' => 'Program Khusus Alumni',
                'body' => "Magang Jepang merupakan program khusus alumni SMK Infokom Bogor.\n\nProgram ini terpisah dari PKL wajib bagi siswa yang masih bersekolah.",
                'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'slug' => 'closing',
                'title' => null,
                'body' => 'Halaman ini merupakan dokumentasi perjalanan alumni SMK Infokom Bogor menuju Jepang dan pengalaman mereka di sana.',
                'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);

        // Empat draf "Tujuan Program" dari migration sebelumnya tidak punya sumber → dinonaktifkan.
        // Hanya baris yang masih berisi teks asli draf (belum diedit admin).
        if (Schema::hasTable('japan_internship_goals')) {
            $drafts = [
                ['Pengalaman kerja nyata', 'Merasakan langsung lingkungan kerja industri, sehingga siswa memahami budaya dan tuntutan dunia kerja profesional.'],
                ['Disiplin dan etos kerja', 'Membentuk kebiasaan tepat waktu, teliti, dan bertanggung jawab pada setiap tugas yang diberikan.'],
                ['Wawasan budaya dan bahasa', 'Memperluas cara pandang melalui interaksi langsung dengan budaya kerja dan bahasa yang berbeda.'],
                ['Bekal karier', 'Menambah nilai diri dan kepercayaan diri siswa untuk melangkah ke dunia kerja maupun pendidikan lanjutan setelah lulus.'],
            ];
            foreach ($drafts as [$title, $description]) {
                DB::table('japan_internship_goals')
                    ->where('title', $title)
                    ->where('description', $description)
                    ->update(['is_active' => false, 'updated_at' => $now]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('japan_internship_experiences');
        Schema::dropIfExists('japan_internship_steps');
        Schema::dropIfExists('japan_internship_texts');
    }
};