<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("ppdb_registrations", function (Blueprint $table) {
            $table->id();
            $table->string("full_name");
            $table->string("email");
            $table->string("phone");
            $table->string("nisn")->nullable();
            $table->string("previous_school")->nullable();
            $table->foreignId("program_id")->nullable()->constrained("programs")->nullOnDelete();
            $table->text("address")->nullable();
            $table->string("document_file")->nullable();
            $table->enum("status", ["pending", "diterima", "ditolak"])->default("pending");
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("ppdb_registrations"); }
};
