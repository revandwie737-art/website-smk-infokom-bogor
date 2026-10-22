@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-navy-900 via-navy-800 to-slate-900 px-6 sm:px-8 py-8 mb-7 text-white animate-fade-in-up">
    <div class="pointer-events-none absolute -top-10 -right-10 h-56 w-56 rounded-full bg-sky-500/25 blur-3xl animate-float"></div>
    <div class="pointer-events-none absolute -bottom-16 -left-10 h-56 w-56 rounded-full bg-navy-400/20 blur-3xl animate-float-slow"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.04]" style="background-image:radial-gradient(circle, #fff 1px, transparent 1px); background-size:22px 22px;"></div>
    <div class="relative">
        <p id="greetingText" class="text-sm text-sky-300 font-medium mb-1">Selamat datang kembali</p>
        <h1 class="text-2xl sm:text-3xl font-extrabold tracking-tight">Halo, {{ explode(' ', auth()->user()->name)[0] }} 👋</h1>
        <p class="text-sm text-slate-300 mt-2 max-w-xl">Berikut ringkasan aktivitas dan data terbaru dari website SMK Infokom Bogor hari ini.</p>
    </div>
</div>

<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-7">
    @php
        $cards = [
            ['label' => 'Total Siswa', 'value' => $stats['students'], 'icon' => 'graduation-cap', 'grad' => 'from-navy-600 to-navy-800', 'link' => route('admin.students.index')],
            ['label' => 'Total Guru', 'value' => $stats['teachers'], 'icon' => 'user-cog', 'grad' => 'from-sky-500 to-sky-700', 'link' => route('admin.teachers.index')],
            ['label' => 'Total Berita', 'value' => $stats['news'], 'icon' => 'newspaper', 'grad' => 'from-emerald-500 to-emerald-700', 'link' => route('admin.news.index')],
            ['label' => 'Pendaftar PPDB Pending', 'value' => $stats['ppdb_pending'], 'icon' => 'user-plus', 'grad' => 'from-amber-500 to-amber-600', 'link' => route('admin.ppdb.index')],
        ];
    @endphp
    @foreach($cards as $i => $card)
        <a href="{{ $card['link'] }}" class="group relative bg-white rounded-2xl border border-slate-100 p-6 overflow-hidden animate-fade-in-up" style="animation-delay: {{ $i * 0.07 }}s">
            <div class="absolute -right-6 -top-6 h-24 w-24 rounded-full bg-gradient-to-br {{ $card['grad'] }} opacity-[0.07] group-hover:opacity-[0.12] group-hover:scale-110 transition-all duration-500"></div>
            <div class="relative flex items-start justify-between mb-5">
                <div class="h-11 w-11 rounded-xl bg-gradient-to-br {{ $card['grad'] }} grid place-items-center text-white shadow-lg shadow-slate-900/10 group-hover:scale-110 group-hover:-rotate-6 transition-transform duration-300">
                    <i data-lucide="{{ $card['icon'] }}" class="w-5 h-5"></i>
                </div>
                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-slate-500 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all"></i>
            </div>
            <p class="text-3xl font-extrabold text-slate-800 tabular-nums count-up" data-target="{{ $card['value'] }}">0</p>
            <p class="text-sm text-slate-400 mt-1">{{ $card['label'] }}</p>
        </a>
    @endforeach
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-100 p-6 animate-fade-in-up" style="animation-delay:.28s">
        <div class="flex items-center justify-between mb-4">
            <p class="font-semibold text-slate-800 flex items-center gap-2"><i data-lucide="newspaper" class="w-4 h-4 text-navy-600"></i> Berita Terbaru</p>
            <a href="{{ route('admin.news.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-700 flex items-center gap-1">Lihat semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i></a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($latestNews as $news)
                <div class="py-3.5 flex items-center justify-between gap-3 group">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="h-9 w-9 rounded-xl bg-slate-100 text-slate-400 grid place-items-center shrink-0 group-hover:bg-navy-50 group-hover:text-navy-600 transition-colors"><i data-lucide="file-text" class="w-4 h-4"></i></div>
                        <div class="min-w-0">
                            <p class="text-sm font-medium text-slate-700 truncate">{{ $news->title }}</p>
                            <p class="text-xs text-slate-400">{{ $news->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="text-xs px-2.5 py-1 rounded-full shrink-0 {{ $news->status === 'published' ? 'bg-emerald-50 text-emerald-600' : 'bg-slate-100 text-slate-500' }}">{{ ucfirst($news->status) }}</span>
                </div>
            @empty
                <div class="py-10 text-center">
                    <i data-lucide="inbox" class="w-8 h-8 text-slate-200 mx-auto mb-2"></i>
                    <p class="text-sm text-slate-400">Belum ada berita.</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 animate-fade-in-up" style="animation-delay:.34s">
        <div class="flex items-center justify-between mb-4">
            <p class="font-semibold text-slate-800 flex items-center gap-2"><i data-lucide="user-plus" class="w-4 h-4 text-amber-600"></i> Pendaftar PPDB</p>
            <a href="{{ route('admin.ppdb.index') }}" class="text-xs font-semibold text-sky-600 hover:text-sky-700">Lihat</a>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($latestRegistrations as $reg)
                <div class="py-3.5 flex items-center gap-3">
                    <div class="h-8 w-8 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0">{{ strtoupper(substr($reg->full_name, 0, 1)) }}</div>
                    <div class="min-w-0">
                        <p class="text-sm font-medium text-slate-700 truncate">{{ $reg->full_name }}</p>
                        <p class="text-xs text-slate-400">{{ $reg->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            @empty
                <div class="py-10 text-center">
                    <i data-lucide="user-plus" class="w-8 h-8 text-slate-200 mx-auto mb-2"></i>
                    <p class="text-sm text-slate-400">Belum ada pendaftar.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<div class="bg-white rounded-2xl border border-slate-100 p-6 mt-6 animate-fade-in-up" style="animation-delay:.4s">
    <p class="font-semibold text-slate-800 mb-5 flex items-center gap-2"><i data-lucide="activity" class="w-4 h-4 text-emerald-600"></i> Aktivitas Terbaru</p>
    <div class="relative">
        @forelse($activities as $i => $log)
            <div class="relative pl-8 pb-5 last:pb-0">
                @if(!$loop->last)<span class="absolute left-[7px] top-3 bottom-0 w-px bg-slate-100"></span>@endif
                <span class="absolute left-0 top-1.5 h-3.5 w-3.5 rounded-full bg-white ring-2 ring-sky-400"></span>
                <p class="text-sm text-slate-600">{{ $log->action }}</p>
                <span class="text-xs text-slate-400">{{ $log->created_at->diffForHumans() }}</span>
            </div>
        @empty
            <div class="py-6 text-center">
                <i data-lucide="activity" class="w-8 h-8 text-slate-200 mx-auto mb-2"></i>
                <p class="text-sm text-slate-400">Belum ada aktivitas.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const hour = new Date().getHours();
    const greeting = hour < 11 ? 'Selamat pagi' : hour < 15 ? 'Selamat siang' : hour < 19 ? 'Selamat sore' : 'Selamat malam';
    const el = document.getElementById('greetingText');
    if (el) el.textContent = greeting + ', semoga harimu menyenangkan';

    document.querySelectorAll('.count-up').forEach(node => {
        const target = parseInt(node.dataset.target, 10) || 0;
        const duration = 900;
        const start = performance.now();
        const step = (now) => {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            node.textContent = Math.round(eased * target).toLocaleString('id-ID');
            if (progress < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    });
});
</script>
@endsection
