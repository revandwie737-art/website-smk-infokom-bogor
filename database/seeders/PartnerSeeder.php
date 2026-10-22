<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Nama mitra sesuai brosur PPDB resmi. Logo belum disertakan (bukan file,
     * cuma nama dari brosur) — admin bisa upload logo lewat dashboard.
     */
    public function run(): void
    {
        $universitas = [
            'Telkom University',
            'Universitas Bunda Mulia',
            'Japan Foundation',
        ];

        $industri = [
            'Bank Syariah Indonesia (BSI)', 'Bank BJB Syariah', 'BONET IT Solution Partner',
            'MSV Studio', 'Cakrawala Digital Indonesia', 'CITRAWEB Solusi Teknologi',
            'Laku', 'IPB Press', 'Jawa Pos', 'Mega Motor', 'Almadita',
            'OSM', 'by.U', 'ADiTV', 'Anteraja', 'MCM', 'Cabs',
            'Azalee Group', 'Tenma Hospital Group', 'Artificial Intelligence Center Indonesia (AiCI)',
        ];

        foreach ($universitas as $i => $name) {
            Partner::updateOrCreate(['name' => $name], ['type' => 'universitas', 'sort_order' => $i]);
        }
        foreach ($industri as $i => $name) {
            Partner::updateOrCreate(['name' => $name], ['type' => 'industri', 'sort_order' => $i]);
        }
    }
}
