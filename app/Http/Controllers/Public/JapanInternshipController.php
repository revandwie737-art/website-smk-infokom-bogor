<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\JapanInternship;
use App\Models\JapanInternshipExperience;
use App\Models\JapanInternshipFact;
use App\Models\JapanInternshipFlow;
use App\Models\JapanInternshipGoal;
use App\Models\JapanInternshipStep;
use App\Models\JapanInternshipText;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class JapanInternshipController extends Controller
{
    public function index()
    {
        $japanInternships = JapanInternship::active()
            ->ordered()
            ->limit(JapanInternship::MAX_ACTIVE)
            ->get();

        return view('public.magang-jepang', [
            'title' => 'Magang Jepang',
            'japanInternships' => $japanInternships,
            'goals' => JapanInternshipGoal::active()->ordered()->get(),
            'facts' => JapanInternshipFact::active()->ordered()->get(),
            'steps' => JapanInternshipStep::active()->ordered()->get(),
            'flows' => JapanInternshipFlow::active()->ordered()->get(),
            'experiences' => JapanInternshipExperience::active()->ordered()->get(),
            'texts' => JapanInternshipText::active()->get()->keyBy('slug'),
        ]);
    }

    /**
     * Menyajikan file foto langsung dari storage/app/public (tanpa tautan public/storage).
     * Kalau filenya hilang atau tidak bisa dibaca, jawabannya menyebut alasannya dengan jelas.
     */
    public function photo(JapanInternship $japanInternship)
    {
        abort_unless($japanInternship->image, 404);

        $path = Storage::disk('public')->path($japanInternship->image);

        if (!is_file($path)) {
            Log::warning('Foto Magang Jepang tidak ditemukan', ['id' => $japanInternship->id, 'path' => $path]);
            abort(404, 'File foto tidak ditemukan di storage.');
        }

        $contents = @file_get_contents($path);

        if ($contents === false || $contents === '') {
            Log::warning('Foto Magang Jepang tidak bisa dibaca', ['id' => $japanInternship->id, 'path' => $path]);
            abort(500, 'File foto ada tetapi tidak bisa dibaca (kemungkinan terkunci OneDrive / belum selesai sinkron).');
        }

        $mime = @mime_content_type($path) ?: 'image/jpeg';

        return response($contents, 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=86400',
        ]);
    }
}