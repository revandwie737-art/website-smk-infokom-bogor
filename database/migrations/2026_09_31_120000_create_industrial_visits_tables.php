<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('industrial_visits', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('company')->nullable();
            $table->date('visit_date')->nullable();
            $table->text('description')->nullable();
            $table->string('cover')->nullable();
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('industrial_visit_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('industrial_visit_id')->constrained('industrial_visits')->cascadeOnDelete();
            $table->string('image');
            $table->string('caption')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        $this->addToInfoMenu();
    }

    public function down(): void
    {
        Schema::dropIfExists('industrial_visit_photos');
        Schema::dropIfExists('industrial_visits');

        try {
            if (Schema::hasTable('info_menu_items') && Schema::hasColumn('info_menu_items', 'url')) {
                DB::table('info_menu_items')->where('url', '/kunjungan-industri')->delete();
            }
        } catch (\Throwable $e) {
            // abaikan
        }
    }

    /**
     * Menambahkan "Kunjungan Industri" ke dropdown Informasi (tabel menu yang diatur
     * dari admin "Menu Informasi (Navbar)"). Sengaja defensif: kalau struktur tabel
     * berbeda, langkah ini dilewati dan menu bisa ditambah manual lewat admin.
     */
    private function addToInfoMenu(): void
    {
        try {
            $t = 'info_menu_items';

            if (! Schema::hasTable($t) || ! Schema::hasColumn($t, 'label') || ! Schema::hasColumn($t, 'url')) {
                return;
            }
            if (DB::table($t)->where('url', '/kunjungan-industri')->exists()) {
                return;
            }

            $row = ['label' => 'Kunjungan Industri', 'url' => '/kunjungan-industri'];

            $optional = [
                'icon' => '🏭',
                'description' => 'Dokumentasi kunjungan ke dunia industri',
                'is_active' => true,
            ];
            foreach ($optional as $column => $value) {
                if (Schema::hasColumn($t, $column)) {
                    $row[$column] = $value;
                }
            }
            if (Schema::hasColumn($t, 'sort_order')) {
                $row['sort_order'] = (int) DB::table($t)->max('sort_order') + 1;
            }
            if (Schema::hasColumn($t, 'created_at')) {
                $row['created_at'] = now();
            }
            if (Schema::hasColumn($t, 'updated_at')) {
                $row['updated_at'] = now();
            }

            DB::table($t)->insert($row);
        } catch (\Throwable $e) {
            // Dilewati; tambahkan manual lewat Admin > Menu Informasi (Navbar).
        }
    }
};