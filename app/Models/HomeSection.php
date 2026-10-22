<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;

class HomeSection extends Model
{
    /** Bagian beranda yang tersedia (urutan bawaan). key = nama file di resources/views/public/home/sections. */
    public const DEFAULTS = [
        ['hero', 'Hero (sampul utama)'],
        ['stats', 'Statistik'],
        ['tentang', 'Tentang Kami'],
        ['sambutan', 'Sambutan Kepala Sekolah'],
        ['program', 'Program Keahlian'],
        ['pengumuman', 'Pengumuman'],
        ['fasilitas', 'Fasilitas'],
        ['berita', 'Berita Terbaru'],
        ['prestasi', 'Prestasi'],
        ['galeri', 'Galeri'],
        ['ppdb_pkl', 'Alur PPDB dan PKL'],
        ['kerjasama', 'Kerjasama dan Mitra'],
        ['penutup', 'Ajakan Penutup'],
    ];

    public const SPACES = ['none' => '0', 'sm' => '2rem', 'md' => '4rem', 'lg' => '6rem', 'xl' => '8rem'];
    public const WIDTHS = ['narrow', 'wide', 'full'];
    public const TITLE_SCALES = ['0.9', '1.1', '1.25', '1.5'];

    protected $fillable = [
        'key', 'label', 'sort_order', 'is_visible', 'space_top', 'space_bottom', 'content_width', 'title_scale',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Daftar bagian beranda urut sesuai pengaturan admin.
     * Aman: kalau tabel belum ada / kosong, dipakai urutan bawaan; bagian baru yang belum tercatat ditaruh di akhir.
     */
    public static function forHome(): Collection
    {
        try {
            $rows = static::orderBy('sort_order')->orderBy('id')->get();
        } catch (\Throwable $e) {
            $rows = collect();
        }

        $known = $rows->pluck('key')->all();
        $next = ($rows->max('sort_order') ?? 0) + 1;
        foreach (self::DEFAULTS as [$key, $label]) {
            if (!in_array($key, $known, true)) {
                $rows->push(new static(['key' => $key, 'label' => $label, 'sort_order' => $next++, 'is_visible' => true]));
            }
        }

        return $rows
            ->filter(fn ($row) => View::exists('public.home.sections.' . $row->key))
            ->values();
    }

    /** CSS variabel untuk wrapper bagian (jarak luar atas/bawah dan skala judul). */
    public function inlineStyle(): string
    {
        $css = [];
        if ($this->space_top && isset(self::SPACES[$this->space_top])) {
            $css[] = '--hs-pt:' . self::SPACES[$this->space_top];
        }
        if ($this->space_bottom && isset(self::SPACES[$this->space_bottom])) {
            $css[] = '--hs-pb:' . self::SPACES[$this->space_bottom];
        }
        if ($this->title_scale && in_array($this->title_scale, self::TITLE_SCALES, true)) {
            $css[] = '--hs-title:' . $this->title_scale;
        }

        return implode(';', $css);
    }

    /** Atribut data untuk wrapper (lebar konten dan penanda skala judul). */
    public function dataAttributes(): string
    {
        $attrs = [];
        if ($this->content_width && in_array($this->content_width, self::WIDTHS, true)) {
            $attrs[] = 'data-width="' . e($this->content_width) . '"';
        }
        if ($this->title_scale && in_array($this->title_scale, self::TITLE_SCALES, true)) {
            $attrs[] = 'data-title="1"';
        }

        return implode(' ', $attrs);
    }
}