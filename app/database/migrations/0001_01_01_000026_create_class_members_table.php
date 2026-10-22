<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("class_members", function (Blueprint $table) {
            $table->id();
            $table->foreignId("class_id")->constrained("classes")->cascadeOnDelete();
            $table->string("name");
            $table->string("role")->default("Anggota");
            $table->string("photo")->nullable();
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("class_members"); }
};
