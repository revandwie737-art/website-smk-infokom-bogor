<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table("ppdb_registrations", function (Blueprint $table) {
            // Identitas tambahan
            $table->string("birth_place")->nullable()->after("full_name");
            $table->date("birth_date")->nullable()->after("birth_place");
            $table->enum("gender", ["L", "P"])->nullable()->after("birth_date");

            // Alamat terstruktur (menggantikan pemakaian kolom "address" lama di form; kolom lama tetap disimpan, tidak dihapus, agar data lama tidak hilang)
            $table->string("address_street")->nullable()->after("address");
            $table->string("address_rt_rw")->nullable()->after("address_street");
            $table->string("address_village")->nullable()->after("address_rt_rw");
            $table->string("address_district")->nullable()->after("address_village");
            $table->string("address_city")->nullable()->after("address_district");
            $table->string("address_postal_code")->nullable()->after("address_city");

            // Data Ayah
            $table->string("father_name")->nullable()->after("address_postal_code");
            $table->string("father_job")->nullable()->after("father_name");
            $table->string("father_phone")->nullable()->after("father_job");

            // Data Ibu
            $table->string("mother_name")->nullable()->after("father_phone");
            $table->string("mother_job")->nullable()->after("mother_name");
            $table->string("mother_phone")->nullable()->after("mother_job");

            // Data Wali (opsional)
            $table->string("guardian_name")->nullable()->after("mother_phone");
            $table->string("guardian_relation")->nullable()->after("guardian_name");
            $table->string("guardian_job")->nullable()->after("guardian_relation");
            $table->string("guardian_phone")->nullable()->after("guardian_job");
            $table->string("guardian_address")->nullable()->after("guardian_phone");
        });

        // gelombang_3 sudah dipakai di form tapi belum diizinkan enum lama — perbaiki agar tidak gagal saat disimpan
        DB::statement("ALTER TABLE ppdb_registrations MODIFY wave ENUM('gelombang_1','gelombang_2','gelombang_3') NULL");
    }

    public function down(): void
    {
        Schema::table("ppdb_registrations", function (Blueprint $table) {
            $table->dropColumn([
                "birth_place", "birth_date", "gender",
                "address_street", "address_rt_rw", "address_village", "address_district", "address_city", "address_postal_code",
                "father_name", "father_job", "father_phone",
                "mother_name", "mother_job", "mother_phone",
                "guardian_name", "guardian_relation", "guardian_job", "guardian_phone", "guardian_address",
            ]);
        });
        DB::statement("ALTER TABLE ppdb_registrations MODIFY wave ENUM('gelombang_1','gelombang_2') NULL");
    }
};
