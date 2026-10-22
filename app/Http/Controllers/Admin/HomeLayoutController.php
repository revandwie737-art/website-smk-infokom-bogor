<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class HomeLayoutController extends Controller
{
    public function index()
    {
        $rows = HomeSection::forHome()->map(fn ($s) => [
            'key' => $s->key,
            'label' => $s->label,
            'is_visible' => (bool) $s->is_visible,
            'space_top' => $s->space_top ?? '',
            'space_bottom' => $s->space_bottom ?? '',
            'content_width' => $s->content_width ?? '',
            'title_scale' => $s->title_scale ?? '',
        ])->values();

        return view('admin.home-layout.index', ['rows' => $rows]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validKeys = collect(HomeSection::DEFAULTS)->pluck(0)->all();
        $labels = collect(HomeSection::DEFAULTS)->mapWithKeys(fn ($d) => [$d[0] => $d[1]]);

        $request->validate([
            'sections' => ['required', 'array', 'min:1'],
            'sections.*.key' => ['required', Rule::in($validKeys)],
            'sections.*.space_top' => ['nullable', Rule::in(array_keys(HomeSection::SPACES))],
            'sections.*.space_bottom' => ['nullable', Rule::in(array_keys(HomeSection::SPACES))],
            'sections.*.content_width' => ['nullable', Rule::in(HomeSection::WIDTHS)],
            'sections.*.title_scale' => ['nullable', Rule::in(HomeSection::TITLE_SCALES)],
        ]);

        DB::transaction(function () use ($request, $labels) {
            foreach (array_values($request->input('sections')) as $i => $row) {
                HomeSection::updateOrCreate(
                    ['key' => $row['key']],
                    [
                        'label' => $labels[$row['key']],
                        'sort_order' => $i + 1,
                        'is_visible' => !empty($row['is_visible']),
                        'space_top' => $row['space_top'] ?: null,
                        'space_bottom' => $row['space_bottom'] ?: null,
                        'content_width' => $row['content_width'] ?: null,
                        'title_scale' => $row['title_scale'] ?: null,
                    ]
                );
            }
        });

        return redirect()->route('admin.home-layout.index')->with('success', 'Tata letak beranda disimpan.');
    }

    public function reset(): RedirectResponse
    {
        DB::transaction(function () {
            HomeSection::query()->delete();
            foreach (HomeSection::DEFAULTS as $i => [$key, $label]) {
                HomeSection::create(['key' => $key, 'label' => $label, 'sort_order' => $i + 1, 'is_visible' => true]);
            }
        });

        return redirect()->route('admin.home-layout.index')->with('success', 'Tata letak beranda dikembalikan ke bawaan.');
    }
}