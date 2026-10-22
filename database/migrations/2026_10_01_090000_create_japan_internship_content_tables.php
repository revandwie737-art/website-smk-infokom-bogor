<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('japan_internship_goals', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('japan_internship_facts', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('value');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Draf awal Tujuan Program (umum, silakan diubah dari dashboard admin).
        $now = now();
        DB::table('japan_internship_goals')->insert([
            [
                'title' => 'Pengalaman kerja nyata',
                'description' => 'Merasakan langsung lingkungan kerja industri, sehingga siswa memahami budaya dan tuntutan dunia kerja profesional.',
                'sort_order' => 1, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Disiplin dan etos kerja',
                'description' => 'Membentuk kebiasaan tepat waktu, teliti, dan bertanggung jawab pada setiap tugas yang diberikan.',
                'sort_order' => 2, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Wawasan budaya dan bahasa',
                'description' => 'Memperluas cara pandang melalui interaksi langsung dengan budaya kerja dan bahasa yang berbeda.',
                'sort_order' => 3, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
            [
                'title' => 'Bekal karier',
                'description' => 'Menambah nilai diri dan kepercayaan diri siswa untuk melangkah ke dunia kerja maupun pendidikan lanjutan setelah lulus.',
                'sort_order' => 4, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('japan_internship_facts');
        Schema::dropIfExists('japan_internship_goals');
    }
};