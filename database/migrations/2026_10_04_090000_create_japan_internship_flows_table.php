<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // "Alur Magang ke Jepang": langkah bernomor yang diisi admin. Kosong = bagian tidak tampil di halaman publik.
        Schema::create('japan_internship_flows', function (Blueprint $table) {
            $table->id();
            $table->string('label')->nullable();   // label waktu opsional, diisi bebas oleh admin
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('japan_internship_flows');
    }
};