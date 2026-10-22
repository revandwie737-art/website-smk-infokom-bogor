@extends('layouts.admin')
@section('title', 'Berita')
@section('content')

<x-admin.page-header
    title="Berita"
    description="Kelola berita dan artikel yang tampil di halaman publik."
    cta="{{ route('admin.news.create') }}"
    cta-label="Tambah Berita"
    :count="$news->total()"
    count-label="berita"
/>

<x-admin.toolbar placeholder="Cari berita..." />

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Judul</th>
                    <th class="px-5 py-3.5">Kategori</th>
                    <th class="px-5 py-3.5">Status</th>
                    <th class="px-5 py-3.5">Tanggal</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($news as $item)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-xl overflow-hidden bg-slate-100 shrink-0">
                                    @if($item->thumbnail)
                                        <img src="{{ asset('storage/' . $item->thumbnail) }}" class="h-full w-full object-cover">
                                    @else
                                        <div class="h-full w-full grid place-items-center text-slate-300"><i data-lucide="newspaper" class="w-4 h-4"></i></div>
                                    @endif
                                </div>
                                <span class="font-medium text-slate-700 line-clamp-1 max-w-xs">{{ $item->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $item->category->name ?? '-' }}</td>
                        <td class="px-5 py-3.5">
                            <x-admin.badge :color="$item->status === 'published' ? 'emerald' : 'slate'" :label="ucfirst($item->status)" />
                        </td>
                        <td class="px-5 py-3.5 text-slate-500">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="route('admin.news.edit', $item)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.news.destroy', $item)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5"><x-admin.empty-state icon="newspaper" title="Belum ada berita" description="Tambahkan berita pertama." /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-6">{{ $news->links() }}</div>
@endsection
