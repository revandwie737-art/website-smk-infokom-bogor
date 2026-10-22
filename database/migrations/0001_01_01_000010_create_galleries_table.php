<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("galleries", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("cover")->nullable();
            $table->string("category")->nullable();
            $table->date("event_date")->nullable();
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });

        Schema::create("gallery_images", function (Blueprint $table) {
            $table->id();
            $table->foreignId("gallery_id")->constrained()->cascadeOnDelete();
            $table->string("image");
            $table->string("caption")->nullable();
            $table->string("alt_text")->nullable();
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists("gallery_images");
        Schema::dropIfExists("galleries");
    }
};
