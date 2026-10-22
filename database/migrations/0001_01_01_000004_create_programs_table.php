<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("programs", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("code")->unique();
            $table->string("slug")->unique();
            $table->string("photo")->nullable();
            $table->string("logo")->nullable();
            $table->text("description")->nullable();
            $table->longText("competencies")->nullable();
            $table->longText("prospects")->nullable();
            $table->longText("facilities")->nullable();
            $table->longText("subjects")->nullable();
            $table->integer("sort_order")->default(0);
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("programs"); }
};
