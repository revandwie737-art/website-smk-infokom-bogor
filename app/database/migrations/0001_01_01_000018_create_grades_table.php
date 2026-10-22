<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("grades", function (Blueprint $table) {
            $table->id();
            $table->foreignId("student_id")->constrained("students")->cascadeOnDelete();
            $table->foreignId("subject_id")->constrained("subjects")->cascadeOnDelete();
            $table->foreignId("academic_year_id")->nullable()->constrained("academic_years")->nullOnDelete();
            $table->decimal("tugas", 5, 2)->nullable();
            $table->decimal("uts", 5, 2)->nullable();
            $table->decimal("uas", 5, 2)->nullable();
            $table->decimal("nilai_akhir", 5, 2)->nullable();
            $table->timestamps();
            $table->unique(["student_id", "subject_id", "academic_year_id"], "grade_unique");
        });
    }
    public function down(): void { Schema::dropIfExists("grades"); }
};
