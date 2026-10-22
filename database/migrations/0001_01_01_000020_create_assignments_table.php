<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("assignments", function (Blueprint $table) {
            $table->id();
            $table->foreignId("class_id")->constrained("classes")->cascadeOnDelete();
            $table->foreignId("subject_id")->constrained("subjects")->cascadeOnDelete();
            $table->foreignId("teacher_id")->nullable()->constrained("teachers")->nullOnDelete();
            $table->string("title");
            $table->text("description")->nullable();
            $table->string("file")->nullable();
            $table->dateTime("deadline");
            $table->timestamps();
        });

        Schema::create("assignment_submissions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("assignment_id")->constrained()->cascadeOnDelete();
            $table->foreignId("student_id")->constrained("students")->cascadeOnDelete();
            $table->string("file");
            $table->text("note")->nullable();
            $table->decimal("score", 5, 2)->nullable();
            $table->timestamp("submitted_at")->nullable();
            $table->timestamps();
            $table->unique(["assignment_id", "student_id"]);
        });
    }
    public function down(): void {
        Schema::dropIfExists("assignment_submissions");
        Schema::dropIfExists("assignments");
    }
};
