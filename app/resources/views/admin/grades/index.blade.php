@extends('layouts.admin')
@section('title', 'Input Nilai')
@section('content')

<x-admin.page-header
    title="Input Nilai"
    description="Pilih kelas dan mata pelajaran, lalu isi nilai Tugas, UTS, dan UAS tiap siswa."
/>

<form method="GET" class="flex flex-wrap items-end gap-3 mb-6 bg-white rounded-2xl border border-slate-100 p-5 animate-fade-in-up">
    <div class="min-w-[200px]">
        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Kelas</label>
        <div class="relative">
            <i data-lucide="school" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <select name="class_id" onchange="this.form.submit()" class="pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
                <option value="">Pilih Kelas</option>
                @foreach($classes as $c)
                    <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="min-w-[220px]">
        <label class="block text-xs font-semibold text-slate-500 mb-1.5">Mata Pelajaran</label>
        <div class="relative">
            <i data-lucide="book-open" class="w-4 h-4 absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <select name="subject_id" onchange="this.form.submit()" class="pl-9 pr-4 py-2.5 rounded-xl border border-slate-200 text-sm w-full focus:outline-none focus:ring-2 focus:ring-sky-300 transition">
                <option value="">Pilih Mata Pelajaran</option>
                @foreach($subjects as $s)
                    <option value="{{ $s->id }}" @selected($subjectId == $s->id)>{{ $s->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
</form>

@if($classId && $subjectId)
<form method="POST" action="{{ route('admin.grades.store') }}" class="bg-white rounded-2xl border border-slate-100 overflow-hidden animate-fade-in-up">
    @csrf
    <input type="hidden" name="subject_id" value="{{ $subjectId }}">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-[11px] font-bold uppercase tracking-wider text-slate-400 bg-slate-50/70 border-b border-slate-100">
                    <th class="px-5 py-3.5">Nama Siswa</th>
                    <th class="px-5 py-3.5">Tugas</th>
                    <th class="px-5 py-3.5">UTS</th>
                    <th class="px-5 py-3.5">UAS</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($students as $i => $student)
                    @php($grade = $grades[$student->id] ?? null)
                    <tr class="hover:bg-slate-50/60 transition-colors">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-navy-600 to-sky-500 text-white grid place-items-center text-xs font-bold shrink-0">{{ strtoupper(substr($student->user->name,0,1)) }}</div>
                                <span class="font-medium text-slate-700">{{ $student->user->name }}</span>
                            </div>
                            <input type="hidden" name="students[{{ $i }}][student_id]" value="{{ $student->id }}">
                        </td>
                        <td class="px-5 py-3.5"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][tugas]" value="{{ $grade->tugas ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 transition"></td>
                        <td class="px-5 py-3.5"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][uts]" value="{{ $grade->uts ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 transition"></td>
                        <td class="px-5 py-3.5"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][uas]" value="{{ $grade->uas ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300 transition"></td>
                    </tr>
                @empty
                    <tr><td colspan="4"><x-admin.empty-state icon="users" title="Belum ada siswa di kelas ini" /></td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-5 border-t border-slate-100">
        <button class="inline-flex items-center gap-2 px-8 py-3 rounded-xl bg-gradient-to-r from-navy-700 to-navy-900 text-white font-semibold hover:shadow-lg hover:shadow-navy-900/20 transition">
            <i data-lucide="check" class="w-4 h-4"></i> Simpan Nilai
        </button>
    </div>
</form>
@else
    <div class="bg-white rounded-2xl border border-slate-100">
        <x-admin.empty-state icon="bar-chart-3" title="Pilih kelas & mata pelajaran" description="Gunakan dropdown di atas untuk mulai input nilai." />
    </div>
@endif
@endsection
