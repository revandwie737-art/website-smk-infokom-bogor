<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("achievements", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("student_name")->nullable();
            $table->enum("category", ["akademik", "olahraga", "seni", "teknologi", "lainnya"])->default("lainnya");
            $table->enum("level", ["sekolah", "kabupaten_kota", "provinsi", "nasional", "internasional"])->default("sekolah");
            $table->year("year");
            $table->text("description")->nullable();
            $table->string("photo")->nullable();
            $table->string("certificate")->nullable();
            $table->string("link")->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("achievements"); }
};
