@extends('layouts.student')
@section('title', 'Nilai')
@section('content')
<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Mata Pelajaran</th>
                <th class="px-5 py-3">Tugas</th>
                <th class="px-5 py-3">UTS</th>
                <th class="px-5 py-3">UAS</th>
                <th class="px-5 py-3">Nilai Akhir</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($grades as $g)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $g->subject->name ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $g->tugas ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $g->uts ?? '-' }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $g->uas ?? '-' }}</td>
                    <td class="px-5 py-3 font-semibold text-navy-800">{{ $g->nilai_akhir ?? '-' }}</td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-5 py-8 text-center text-slate-400">Belum ada nilai yang diinput.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
