@extends('layouts.admin')
@section('title', 'Kategori Berita')
@section('content')

<x-admin.page-header
    title="Kategori Berita"
    description="Kelola kategori untuk mengelompokkan berita di halaman publik."
    :count="$categories->count()"
    count-label="kategori"
/>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                        <th class="px-5 py-3.5">Nama Kategori</th>
                        <th class="px-5 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($categories as $cat)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-3">
                                    <div class="h-8 w-8 rounded-lg bg-sky-50 text-sky-600 grid place-items-center shrink-0"><i data-lucide="tag" class="w-4 h-4"></i></div>
                                    <span class="font-medium text-slate-700">{{ $cat->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-3.5">
                                <div class="flex justify-end">
                                    <x-admin.icon-delete-form :action="route('admin.categories.destroy', $cat)" />
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="2"><x-admin.empty-state icon="tag" title="Belum ada kategori" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 h-fit animate-fade-in-up">
        <p class="font-semibold text-slate-800 mb-1 flex items-center gap-2"><i data-lucide="plus-circle" class="w-4 h-4 text-sky-600"></i> Tambah Kategori</p>
        <p class="text-xs text-slate-400 mb-4">Buat kategori baru untuk berita.</p>
        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Nama kategori" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            <button class="w-full py-2.5 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white font-semibold inline-flex items-center justify-center gap-2 hover:shadow-lg hover:shadow-navy-900/20 transition">
                <i data-lucide="plus" class="w-4 h-4"></i> Tambah
            </button>
        </form>
    </div>
</div>
@endsection
