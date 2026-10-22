<!-- STATS -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-10">
    <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-900/15 grid grid-cols-2 md:grid-cols-4 divide-x divide-y md:divide-y-0 divide-slate-100" data-aos="fade-up">
        @php
            $stats = [
                ['label' => 'Akreditasi', 'value' => $set('akreditasi', 'A'), 'raw' => true],
                ['label' => 'Siswa', 'value' => (int)$set('siswa_laki', 0) + (int)$set('siswa_perempuan', 0)],
                ['label' => 'Guru', 'value' => (int)$set('jumlah_guru', 0)],
                ['label' => 'Program Keahlian', 'value' => $programs->count()],
            ];
        @endphp
        @foreach($stats as $s)
            <div class="p-6 text-center">
                @if(($s['raw'] ?? false))
                    <p class="text-3xl md:text-4xl font-extrabold text-navy-800">{{ $s['value'] }}</p>
                @else
                    <p class="text-3xl md:text-4xl font-extrabold text-navy-800"><span data-counter="{{ $s['value'] }}">0</span></p>
                @endif
                <p class="text-xs md:text-sm text-slate-400 mt-1">{{ $s['label'] }}</p>
            </div>
        @endforeach
    </div>
</section>