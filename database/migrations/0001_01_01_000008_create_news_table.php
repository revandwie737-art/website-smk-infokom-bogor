<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("news", function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug")->unique();
            $table->string("thumbnail")->nullable();
            $table->longText("content");
            $table->text("excerpt")->nullable();
            $table->string("instagram_url")->nullable();
            $table->foreignId("category_id")->nullable()->constrained("categories")->nullOnDelete();
            $table->foreignId("author_id")->nullable()->constrained("users")->nullOnDelete();
            $table->enum("status", ["draft", "published"])->default("draft");
            $table->timestamp("published_at")->nullable();
            $table->unsignedBigInteger("views")->default(0);
            $table->string("seo_title")->nullable();
            $table->string("seo_description")->nullable();
            $table->timestamps();
            $table->index(["status", "published_at"]);
        });
    }
    public function down(): void { Schema::dropIfExists("news"); }
};
