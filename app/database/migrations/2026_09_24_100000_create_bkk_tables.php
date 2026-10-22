<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("bkk_jobs", function (Blueprint $table) {
            $table->id();
            $table->string("company_name");
            $table->string("position");
            $table->string("location")->nullable();
            $table->foreignId("program_id")->nullable()->constrained("programs")->nullOnDelete();
            $table->text("qualifications")->nullable();
            $table->enum("job_type", ["penuh_waktu", "paruh_waktu", "magang", "kontrak"])->default("penuh_waktu");
            $table->date("deadline")->nullable();
            $table->text("description")->nullable();
            $table->string("apply_link")->nullable();
            $table->boolean("is_active")->default(true);
            $table->timestamps();
        });

        Schema::create("bkk_partners", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("logo")->nullable();
            $table->text("description")->nullable();
            $table->string("website")->nullable();
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });

        Schema::table("events", function (Blueprint $table) {
            $table->string("category")->default("umum")->after("title");
        });
    }
    public function down(): void {
        Schema::dropIfExists("bkk_jobs");
        Schema::dropIfExists("bkk_partners");
        Schema::table("events", fn (Blueprint $table) => $table->dropColumn("category"));
    }
};
