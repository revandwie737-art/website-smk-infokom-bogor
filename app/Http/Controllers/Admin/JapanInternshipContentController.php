<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JapanInternshipExperience;
use App\Models\JapanInternshipFact;
use App\Models\JapanInternshipFlow;
use App\Models\JapanInternshipGoal;
use App\Models\JapanInternshipStep;
use App\Models\JapanInternshipText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Konten pendamping halaman Magang Jepang (semua dikelola dari dashboard admin):
 *  - Teks halaman      (intro, program khusus alumni, penutup)
 *  - Perjalanan        (catatan tambahan di jalur perjalanan)
 *  - Alur Magang       (langkah bernomor "Alur Magang ke Jepang")
 *  - Pengalaman        (pengalaman yang didapat)
 *  - Tujuan Program    (judul + penjelasan)
 *  - Informasi Program (label + isi, mis. "Durasi" → "3 bulan")
 * Bagian yang kosong / nonaktif tidak tampil di halaman publik.
 */
class JapanInternshipContentController extends Controller
{
    /* ------------------------------- Teks halaman ------------------------------- */

    public function updateText(Request $request, JapanInternshipText $text): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['nullable', 'string', 'max:150'],
            'body' => ['nullable', 'string', 'max:4000'],
        ]);
        $data['is_active'] = $request->boolean('is_active');

        $text->update($data);

        return $this->done('Teks halaman diperbarui.');
    }

    /* ------------------------------- Perjalanan -------------------------------- */

    public function storeStep(Request $request): RedirectResponse
    {
        JapanInternshipStep::create($this->stepData($request));

        return $this->done('Catatan perjalanan ditambahkan.');
    }

    public function updateStep(Request $request, JapanInternshipStep $step): RedirectResponse
    {
        $step->update($this->stepData($request));

        return $this->done('Catatan perjalanan diperbarui.');
    }

    public function destroyStep(JapanInternshipStep $step): RedirectResponse
    {
        $step->delete();

        return $this->done('Catatan perjalanan dihapus.');
    }

    /* ------------------------------- Alur Magang ------------------------------- */

    public function storeFlow(Request $request): RedirectResponse
    {
        JapanInternshipFlow::create($this->stepData($request, 'Judul langkah wajib diisi.'));

        return $this->done('Langkah alur ditambahkan.');
    }

    public function updateFlow(Request $request, JapanInternshipFlow $flow): RedirectResponse
    {
        $flow->update($this->stepData($request, 'Judul langkah wajib diisi.'));

        return $this->done('Langkah alur diperbarui.');
    }

    public function destroyFlow(JapanInternshipFlow $flow): RedirectResponse
    {
        $flow->delete();

        return $this->done('Langkah alur dihapus.');
    }

    /* ------------------------------- Pengalaman -------------------------------- */

    public function storeExperience(Request $request): RedirectResponse
    {
        JapanInternshipExperience::create($this->titleDescriptionData($request, 'Judul pengalaman wajib diisi.'));

        return $this->done('Pengalaman ditambahkan.');
    }

    public function updateExperience(Request $request, JapanInternshipExperience $experience): RedirectResponse
    {
        $experience->update($this->titleDescriptionData($request, 'Judul pengalaman wajib diisi.'));

        return $this->done('Pengalaman diperbarui.');
    }

    public function destroyExperience(JapanInternshipExperience $experience): RedirectResponse
    {
        $experience->delete();

        return $this->done('Pengalaman dihapus.');
    }

    /* ------------------------------ Tujuan Program ----------------------------- */

    public function storeGoal(Request $request): RedirectResponse
    {
        JapanInternshipGoal::create($this->titleDescriptionData($request, 'Judul tujuan wajib diisi.'));

        return $this->done('Tujuan program ditambahkan.');
    }

    public function updateGoal(Request $request, JapanInternshipGoal $goal): RedirectResponse
    {
        $goal->update($this->titleDescriptionData($request, 'Judul tujuan wajib diisi.'));

        return $this->done('Tujuan program diperbarui.');
    }

    public function destroyGoal(JapanInternshipGoal $goal): RedirectResponse
    {
        $goal->delete();

        return $this->done('Tujuan program dihapus.');
    }

    /* ----------------------------- Informasi Program --------------------------- */

    public function storeFact(Request $request): RedirectResponse
    {
        JapanInternshipFact::create($this->factData($request));

        return $this->done('Informasi program ditambahkan.');
    }

    public function updateFact(Request $request, JapanInternshipFact $fact): RedirectResponse
    {
        $fact->update($this->factData($request));

        return $this->done('Informasi program diperbarui.');
    }

    public function destroyFact(JapanInternshipFact $fact): RedirectResponse
    {
        $fact->delete();

        return $this->done('Informasi program dihapus.');
    }

    /* ----------------------------------- helper -------------------------------- */

    private function titleDescriptionData(Request $request, string $titleRequiredMessage): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], ['title.required' => $titleRequiredMessage]);

        return $this->withFlags($request, $data);
    }

    private function stepData(Request $request, string $titleRequiredMessage = 'Judul catatan wajib diisi.'): array
    {
        $data = $request->validate([
            'label' => ['nullable', 'string', 'max:80'],
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:1000'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], ['title.required' => $titleRequiredMessage]);

        return $this->withFlags($request, $data);
    }

    private function factData(Request $request): array
    {
        $data = $request->validate([
            'label' => ['required', 'string', 'max:80'],
            'value' => ['required', 'string', 'max:200'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], [
            'label.required' => 'Label wajib diisi (contoh: Durasi).',
            'value.required' => 'Isi wajib diisi (contoh: 3 bulan).',
        ]);

        return $this->withFlags($request, $data);
    }

    private function withFlags(Request $request, array $data): array
    {
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active');

        return $data;
    }

    private function done(string $message): RedirectResponse
    {
        return redirect()->to(route('admin.magang-jepang.index') . '#konten')->with('success', $message);
    }
}