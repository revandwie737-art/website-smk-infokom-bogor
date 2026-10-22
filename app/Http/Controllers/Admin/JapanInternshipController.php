<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JapanInternship;
use App\Models\JapanInternshipExperience;
use App\Models\JapanInternshipFact;
use App\Models\JapanInternshipFlow;
use App\Models\JapanInternshipGoal;
use App\Models\JapanInternshipStep;
use App\Models\JapanInternshipText;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class JapanInternshipController extends Controller
{
    private const LIMIT_MESSAGE = 'Maksimal 3 foto Magang Jepang dapat ditampilkan.';

    public function index()
    {
        $items = JapanInternship::ordered()->get();
        $activeCount = $items->where('is_active', true)->count();
        $goals = JapanInternshipGoal::ordered()->get();
        $facts = JapanInternshipFact::ordered()->get();
        $steps = JapanInternshipStep::ordered()->get();
        $flows = JapanInternshipFlow::ordered()->get();
        $experiences = JapanInternshipExperience::ordered()->get();
        $texts = JapanInternshipText::orderBy('id')->get();

        return view('admin.magang-jepang.index', compact('items', 'activeCount', 'goals', 'facts', 'steps', 'flows', 'experiences', 'texts'));
    }

    public function create()
    {
        return view('admin.magang-jepang.form', [
            'item' => new JapanInternship(),
            'activeCount' => $this->activeCount(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);

        if ($data['is_active'] && $this->activeCount() >= JapanInternship::MAX_ACTIVE) {
            return $this->limitError();
        }

        $data['image'] = $request->file('image')->store('japan-internships', 'public');

        JapanInternship::create($data);

        return redirect()->route('admin.magang-jepang.index')
            ->with('success', 'Foto Magang Jepang berhasil ditambahkan.');
    }

    public function edit(JapanInternship $japanInternship)
    {
        return view('admin.magang-jepang.form', [
            'item' => $japanInternship,
            'activeCount' => $this->activeCount($japanInternship->id),
        ]);
    }

    public function update(Request $request, JapanInternship $japanInternship): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($data['is_active'] && $this->activeCount($japanInternship->id) >= JapanInternship::MAX_ACTIVE) {
            return $this->limitError();
        }

        $oldImage = $japanInternship->image;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('japan-internships', 'public');
        }

        $japanInternship->update($data);

        // Foto lama dihapus setelah data baru tersimpan, supaya tidak pernah ada gambar rusak.
        if ($request->hasFile('image') && $oldImage) {
            Storage::disk('public')->delete($oldImage);
        }

        return redirect()->route('admin.magang-jepang.index')
            ->with('success', 'Data Magang Jepang berhasil diperbarui.');
    }

    public function toggle(JapanInternship $japanInternship): RedirectResponse
    {
        if (!$japanInternship->is_active && $this->activeCount($japanInternship->id) >= JapanInternship::MAX_ACTIVE) {
            return $this->limitError();
        }

        $japanInternship->update(['is_active' => !$japanInternship->is_active]);

        return back()->with('success', $japanInternship->is_active ? 'Foto diaktifkan.' : 'Foto dinonaktifkan.');
    }

    public function destroy(JapanInternship $japanInternship): RedirectResponse
    {
        if ($japanInternship->image) {
            Storage::disk('public')->delete($japanInternship->image);
        }

        $japanInternship->delete();

        return redirect()->route('admin.magang-jepang.index')
            ->with('success', 'Data Magang Jepang berhasil dihapus.');
    }

    /* ------------------------------------------------------------------ */

    private function activeCount(?int $exceptId = null): int
    {
        return JapanInternship::active()
            ->when($exceptId, fn ($q) => $q->where('id', '!=', $exceptId))
            ->count();
    }

    private function limitError(): RedirectResponse
    {
        return back()->withInput()->withErrors(['is_active' => self::LIMIT_MESSAGE]);
    }

    private function validated(Request $request, bool $creating): array
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'description' => ['nullable', 'string', 'max:2000'],
            'image' => [$creating ? 'required' : 'nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'source_name' => ['nullable', 'string', 'max:150'],
            'source_url' => ['nullable', 'url', 'max:500'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:9999'],
        ], [
            'title.required' => 'Judul wajib diisi.',
            'image.required' => 'Foto wajib diunggah.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format foto harus JPG, JPEG, PNG, atau WEBP.',
            'image.max' => 'Ukuran foto maksimal 2 MB.',
            'source_url.url' => 'Link sumber harus berupa URL lengkap, contoh: https://example.com',
        ]);

        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);
        $data['is_active'] = $request->boolean('is_active');

        if (!$request->hasFile('image')) {
            unset($data['image']);
        }

        return $data;
    }
}