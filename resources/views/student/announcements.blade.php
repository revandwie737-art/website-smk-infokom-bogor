@extends('layouts.student')
@section('title', 'Pengumuman')
@section('content')
<div class="space-y-4">
    @forelse($announcements as $a)
        <div class="bg-white rounded-2xl border border-slate-100 p-6">
            @php($colors = ['high' => 'bg-red-50 text-red-500', 'normal' => 'bg-sky-50 text-sky-600', 'low' => 'bg-slate-100 text-slate-500'])
            <span class="text-xs px-2.5 py-1 rounded-full {{ $colors[$a->priority] ?? '' }}">{{ ucfirst($a->priority) }}</span>
            <p class="font-semibold text-slate-800 mt-3">{{ $a->title }}</p>
            <p class="text-sm text-slate-500 mt-2 whitespace-pre-line">{{ $a->content }}</p>
            <p class="text-xs text-slate-400 mt-3">{{ $a->created_at->translatedFormat('d F Y') }}</p>
        </div>
    @empty
        <p class="text-slate-400 text-sm">Belum ada pengumuman.</p>
    @endforelse
</div>
<div class="mt-6">{{ $announcements->links() }}</div>
@endsection
