@extends('layouts.student')
@section('title', 'Kehadiran')
@section('content')
<div class="bg-white rounded-2xl border border-slate-100 p-6 mb-6 text-center">
    <p class="text-4xl font-extrabold text-navy-800">{{ $percentage }}%</p>
    <p class="text-sm text-slate-400 mt-1">Persentase Kehadiran Keseluruhan</p>
</div>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Tanggal</th>
                <th class="px-5 py-3">Status</th>
                <th class="px-5 py-3">Catatan</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($attendances as $a)
                <tr>
                    <td class="px-5 py-3 text-slate-700">{{ $a->date->translatedFormat('d F Y') }}</td>
                    <td class="px-5 py-3">
                        @php($colors = ['hadir' => 'bg-emerald-50 text-emerald-600', 'izin' => 'bg-sky-50 text-sky-600', 'sakit' => 'bg-amber-50 text-amber-600', 'alpha' => 'bg-red-50 text-red-500'])
                        <span class="text-xs px-2.5 py-1 rounded-full {{ $colors[$a->status] ?? '' }}">{{ ucfirst($a->status) }}</span>
                    </td>
                    <td class="px-5 py-3 text-slate-500">{{ $a->note ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="3" class="px-5 py-8 text-center text-slate-400">Belum ada data kehadiran.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@if(method_exists($attendances, 'links'))
    <div class="mt-6">{{ $attendances->links() }}</div>
@endif
@endsection
