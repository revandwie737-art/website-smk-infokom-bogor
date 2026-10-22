@extends('layouts.admin')
@section('title', 'Detail Pesan')
@section('content')

<x-admin.form-header title="Detail Pesan" :back-route="route('admin.messages.index')" />

<div class="max-w-2xl bg-white rounded-2xl border border-slate-100 p-6 sm:p-8 animate-fade-in-up">
    <div class="flex items-center gap-4 pb-5 border-b border-slate-100">
        <div class="h-12 w-12 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center font-bold shrink-0">{{ strtoupper(substr($message->name,0,1)) }}</div>
        <div class="min-w-0">
            <p class="font-semibold text-slate-800">{{ $message->name }}</p>
            <p class="text-sm text-slate-400">{{ $message->email }}</p>
        </div>
        <span class="ml-auto text-xs text-slate-400 shrink-0">{{ $message->created_at->translatedFormat('d M Y, H:i') }}</span>
    </div>

    <div class="py-5 space-y-4">
        @if($message->subject)
            <div>
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Subjek</p>
                <p class="text-slate-700 font-medium">{{ $message->subject }}</p>
            </div>
        @endif
        <div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Pesan</p>
            <p class="text-slate-600 leading-relaxed whitespace-pre-line">{{ $message->message }}</p>
        </div>
    </div>

    <div class="flex gap-3 pt-5 border-t border-slate-100">
        <a href="mailto:{{ $message->email }}{{ $message->subject ? '?subject=RE: ' . rawurlencode($message->subject) : '' }}" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white text-sm font-semibold hover:shadow-lg hover:shadow-navy-900/20 transition">
            <i data-lucide="reply" class="w-4 h-4"></i> Balas via Email
        </a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
            @csrf @method('DELETE')
            <button class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl border border-red-200 text-red-500 text-sm font-semibold hover:bg-red-50 transition">
                <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
            </button>
        </form>
    </div>
</div>
@endsection
