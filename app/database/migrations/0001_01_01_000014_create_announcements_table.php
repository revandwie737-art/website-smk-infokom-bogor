<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("announcements", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->longText("content");
            $table->enum("priority", ["low", "normal", "high"])->default("normal");
            $table->boolean("is_active")->default(true);
            $table->date("expires_at")->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists("announcements"); }
};
