<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table("facilities", function (Blueprint $table) {
            $table->json("extra_photos")->nullable();
        });
    }
    public function down(): void {
        Schema::table("facilities", function (Blueprint $table) {
            $table->dropColumn("extra_photos");
        });
    }
};