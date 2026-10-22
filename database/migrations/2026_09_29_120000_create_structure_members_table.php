<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create("structure_members", function (Blueprint $table) {
            $table->id();
            // section: waka | inti | kaprog | staff
            $table->string("section");
            // hanya dipakai saat section = staff, jadi judul kelompok bebas (mis. "Pembina OSIS")
            $table->string("group_label")->nullable();
            $table->string("name");
            $table->string("role")->nullable();
            $table->integer("sort_order")->default(0);
            $table->timestamps();
        });

        // Data yang tadinya tertulis langsung di kode, dipindah ke sini supaya
        // tampilan tidak kosong setelah migrate, dan sejak saat ini bisa diedit dari admin.
        $now = now();
        $rows = [];
        $push = function (string $section, string $name, ?string $role, int $order, ?string $group = null) use (&$rows, $now) {
            $rows[] = ["section" => $section, "group_label" => $group, "name" => $name, "role" => $role, "sort_order" => $order, "created_at" => $now, "updated_at" => $now];
        };

        $waka = [
            ["Mila Yaelasari, M.Pd.", "Bidang Kurikulum"],
            ["Dea Rijalul Fikri, S.Kom.,Gr.", "Bidang Kesiswaan"],
            ["R. Radiani Srirestuti Dewi, SS.,Gr.", "Bidang Humas & Industri"],
            ["Heny Handayani, S.Pd.", "Bidang Pengembangan SDM"],
            ["Agus Tiyono, M.Pd.", "Bidang Sarana & Prasarana"],
        ];
        foreach ($waka as $i => $w) $push("waka", $w[0], $w[1], $i);

        $inti = [
            ["Aditya Nugraha, S.T.", "Ketua Manajemen Mutu"],
            ["Cahyadi Rozi, S.T.", "Kepala Tata Usaha"],
            ["Drs. Puji Marhaen Waluyo", "Kepala Perpustakaan"],
            ["Putri Riandini, S.Hut., M.Pd.,Gr.", "Kepala Bendahara"],
        ];
        foreach ($inti as $i => $w) $push("inti", $w[0], $w[1], $i);

        $kaprog = [
            ["Aditya Nugraha, S.T.", "Kaprog TKJ"],
            ["Ridwan Hala, S.Kom.,Gr.", "Kaprog RPL"],
            ["Muhammad Ibnu Arif, S.IKom.", "Kaprog DKV"],
            ["Erli Suherli, A.Md.Kom.", "Kaprog PSPT"],
        ];
        foreach ($kaprog as $i => $w) $push("kaprog", $w[0], $w[1], $i);

        $groups = [
            "Pembina OSIS" => ["Ahmad Hotib, S.Pd.I", "Abdul Azis, M.Pd."],
            "Staf Kurikulum" => ["Vera Yuni Astuti, SP., M.IKom.,Gr.", "M. Fauzan Arifin, S.IKom.,Gr."],
            "Guru Bimbingan & Konseling" => ["Dra. Popon Puspitasari", "Richo Santana, S.Kom.", "Dian Hardianti, S.Kom.,Gr."],
            "Staf Bendahara" => ["Yeni Yuliawati, S.Pd.,Gr.", "Rita Widyastuti", "Eva Farida Rahayu, S.Pd.,Gr."],
            "Staf Tata Usaha" => ["Jayadi, S.Pd.,Gr.", "Yadi Setiadi, S.Sos.,Gr.", "Siti Nuraeni"],
            "Staf Perpustakaan" => ["Reza Prafitriansyah, S.Kom.,Gr."],
            "Guru" => ["Dra. Diana Octaria", "Nabila Ahmadia Pratama, S.Pd.", "Erwin Hasiholan Gultom, S.Kom.", "Widyatama Nuranisa, SM.", "Dara Purwanita, S.Pd.,Gr."],
        ];
        $order = 0;
        foreach ($groups as $label => $members) {
            foreach ($members as $name) $push("staff", $name, null, $order++, $label);
        }

        DB::table("structure_members")->insert($rows);
    }
    public function down(): void {
        Schema::dropIfExists("structure_members");
    }
};