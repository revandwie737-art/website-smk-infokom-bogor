<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\IndustrialVisit;
use App\Models\IndustrialVisitPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndustrialVisitController extends Controller
{
    private function rules(): array
    {
        return [
            'title' => 'required|string|max:150',
            'company' => 'nullable|string|max:150',
            'visit_date' => 'nullable|date',
            'description' => 'nullable|string|max:5000',
            'cover' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
        ];
    }

    public function index()
    {
        $visits = IndustrialVisit::withCount('photos')->with('photos')
            ->orderByDesc('visit_date')->orderByDesc('id')->get();

        return view('admin.industrial-visits.index', compact('visits'));
    }

    public function create()
    {
        return view('admin.industrial-visits.form', ['visit' => new IndustrialVisit()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['is_published'] = $request->boolean('is_published');
        unset($data['images']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('industrial-visits', 'public');
        } else {
            unset($data['cover']);
        }

        $visit = IndustrialVisit::create($data);
        $this->storePhotos($request, $visit);

        ActivityLog::log(auth()->user()->name . ' membuat kunjungan industri: ' . $visit->title);

        return redirect()->route('admin.industrial-visits.edit', $visit)
            ->with('success', 'Kunjungan industri berhasil dibuat. Foto galeri bisa dikelola di bawah.');
    }

    public function edit(IndustrialVisit $industrialVisit)
    {
        $industrialVisit->load('photos');

        return view('admin.industrial-visits.form', ['visit' => $industrialVisit]);
    }

    public function update(Request $request, IndustrialVisit $industrialVisit)
    {
        $data = $request->validate($this->rules());
        $data['is_published'] = $request->boolean('is_published');
        unset($data['images']);

        if ($request->hasFile('cover')) {
            if ($industrialVisit->cover) {
                Storage::disk('public')->delete($industrialVisit->cover);
            }
            $data['cover'] = $request->file('cover')->store('industrial-visits', 'public');
        } else {
            unset($data['cover']);
        }

        $industrialVisit->update($data);
        $this->storePhotos($request, $industrialVisit);

        ActivityLog::log(auth()->user()->name . ' memperbarui kunjungan industri: ' . $industrialVisit->title);

        return redirect()->route('admin.industrial-visits.edit', $industrialVisit)
            ->with('success', 'Kunjungan industri berhasil diperbarui.');
    }

    public function destroy(IndustrialVisit $industrialVisit)
    {
        foreach ($industrialVisit->photos as $photo) {
            Storage::disk('public')->delete($photo->image);
        }
        if ($industrialVisit->cover) {
            Storage::disk('public')->delete($industrialVisit->cover);
        }
        $title = $industrialVisit->title;
        $industrialVisit->delete();

        ActivityLog::log(auth()->user()->name . ' menghapus kunjungan industri: ' . $title);

        return redirect()->route('admin.industrial-visits.index')->with('success', 'Kunjungan industri berhasil dihapus.');
    }

    /** Ganti file foto dan/atau ubah keterangan satu foto galeri. */
    public function updatePhoto(Request $request, IndustrialVisitPhoto $photo)
    {
        $data = $request->validate([
            'image' => 'nullable|image|max:2048',
            'caption' => 'nullable|string|max:200',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($photo->image);
            $photo->image = $request->file('image')->store('industrial-visits', 'public');
        }
        $photo->caption = $data['caption'] ?? null;
        $photo->save();

        return redirect()->route('admin.industrial-visits.edit', $photo->industrial_visit_id)
            ->with('success', 'Foto berhasil diperbarui.');
    }

    public function destroyPhoto(IndustrialVisitPhoto $photo)
    {
        Storage::disk('public')->delete($photo->image);
        $visitId = $photo->industrial_visit_id;
        $photo->delete();

        return redirect()->route('admin.industrial-visits.edit', $visitId)->with('success', 'Foto berhasil dihapus.');
    }

    private function storePhotos(Request $request, IndustrialVisit $visit): void
    {
        if (! $request->hasFile('images')) {
            return;
        }

        $order = (int) IndustrialVisitPhoto::where('industrial_visit_id', $visit->id)->max('sort_order');
        foreach ($request->file('images') as $file) {
            $order++;
            IndustrialVisitPhoto::create([
                'industrial_visit_id' => $visit->id,
                'image' => $file->store('industrial-visits', 'public'),
                'sort_order' => $order,
            ]);
        }
    }
}