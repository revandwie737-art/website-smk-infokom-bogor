@extends('layouts.admin')
@section('title', 'Video')
@section('content')

<x-admin.page-header
    title="Video"
    description="Kelola video YouTube yang tampil di halaman publik."
    cta="{{ route('admin.videos.create') }}"
    cta-label="Tambah Video"
    :count="$videos->count()"
    count-label="video"
/>

<div class="bg-white rounded-2xl border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Judul</th>
                    <th class="px-5 py-3.5">URL YouTube</th>
                    <th class="px-5 py-3.5 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($videos as $video)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-9 w-9 rounded-xl bg-red-50 text-red-500 grid place-items-center shrink-0"><i data-lucide="youtube" class="w-4 h-4"></i></div>
                                <span class="font-medium text-slate-700">{{ $video->title }}</span>
                            </div>
                        </td>
                        <td class="px-5 py-3.5 text-slate-400 truncate max-w-xs">{{ $video->youtube_url }}</td>
                        <td class="px-5 py-3.5">
                            <div class="flex gap-2 justify-end">
                                <x-admin.icon-link :href="$video->youtube_url" target="_blank" icon="play" color="red" label="Tonton" />
                                <x-admin.icon-link :href="route('admin.videos.edit', $video)" icon="pencil" color="sky" label="Edit" />
                                <x-admin.icon-delete-form :action="route('admin.videos.destroy', $video)" />
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3"><x-admin.empty-state icon="video" title="Belum ada video" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
