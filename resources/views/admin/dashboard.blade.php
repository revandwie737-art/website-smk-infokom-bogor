@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
    @php
        $cards = [
            ['label' => 'Total Siswa', 'value' => $stats['students'], 'color' => 'bg-navy-700', 'icon' => '🎓'],
            ['label' => 'Total Guru', 'value' => $stats['teachers'], 'color' => 'bg-sky-600', 'icon' => '👩‍🏫'],
            ['label' => 'Total Berita', 'value' => $stats['news'], 'color' => 'bg-emerald-600', 'icon' => '📰'],
            ['label' => 'Pendaftar PPDB Pending', 'value' => $stats['ppdb_pending'], 'color' => 'bg-amber-500', 'icon' => '📝'],
        ];
    @endphp
    @foreach($cards as $card)
        <div class="hover-lift bg-white rounded-2xl border border-slate-100 p-6">
            <div class="h-11 w-11 rounded-xl {{ $card['color'] }} mb-4 grid place-items-center text-lg">{{ $card['icon'] }}</div>
            <p class="text-3xl font-extrabold text-slate-800"><span data-counter="{{ $card['value'] }}">0</span></p>
            <p class="text-sm text-slate-400 mt-1">{{ $card['label'] }}</p>
        </div>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="hover-lift lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6">
        <p class="font-semibold text-slate-800 mb-4">Berita Terbaru</p>
        <div class="divide-y divide-slate-100">
            @forelse($latestNews as $news)
                <div class="py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-700">{{ $news->title }}</p>
                        <p class="text-xs text-slate-400">{{ $news->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="text-xs px-2.5 py-1 rounded-full {{ $news->status === 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">
                        {{ ucfirst($news->status) }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-slate-400 py-3">Belum ada berita.</p>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6">
        <p class="font-semibold text-slate-800 mb-4">Pendaftar PPDB Terbaru</p>
        <div class="divide-y divide-slate-100">
            @forelse($latestRegistrations as $reg)
                <div class="py-3">
                    <p class="text-sm font-medium text-slate-700">{{ $reg->full_name }}</p>
                    <p class="text-xs text-slate-400">{{ $reg->created_at->diffForHumans() }}</p>
                </div>
            @empty
                <p class="text-sm text-slate-400 py-3">Belum ada pendaftar.</p>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 p-6 mt-6">
    <p class="font-semibold text-slate-800 mb-4">Aktivitas Terbaru</p>
    <div class="divide-y divide-slate-100">
        @forelse($activities as $log)
            <div class="py-3 text-sm text-slate-600">
                {{ $log->action }}
                <span class="text-xs text-slate-400 ml-2">{{ $log->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <p class="text-sm text-slate-400 py-3">Belum ada aktivitas.</p>
        @endforelse
    </div>
</div>
@endsection
