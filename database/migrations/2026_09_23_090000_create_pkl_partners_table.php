<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("pkl_partners", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("field")->nullable(); // bidang / program PKL
            $table->string("address")->nullable();
            $table->text("description")->nullable();
            $table->string("logo")->nullable();
            $table->string("website")->nullable();
            $table->boolean("is_active")->default(true);
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("pkl_partners"); }
};
