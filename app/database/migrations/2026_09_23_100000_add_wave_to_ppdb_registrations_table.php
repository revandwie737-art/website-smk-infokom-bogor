<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table("ppdb_registrations", function (Blueprint $table) {
            $table->enum("wave", ["gelombang_1", "gelombang_2"])->nullable()->after("program_id");
        });
    }
    public function down(): void {
        Schema::table("ppdb_registrations", function (Blueprint $table) {
            $table->dropColumn("wave");
        });
    }
};
