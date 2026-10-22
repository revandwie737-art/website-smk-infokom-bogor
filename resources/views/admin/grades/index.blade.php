@extends('layouts.admin')
@section('title', 'Input Nilai')
@section('content')
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <select name="class_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
        <option value="">Pilih Kelas</option>
        @foreach($classes as $c)
            <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <select name="subject_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
        <option value="">Pilih Mata Pelajaran</option>
        @foreach($subjects as $s)
            <option value="{{ $s->id }}" @selected($subjectId == $s->id)>{{ $s->name }}</option>
        @endforeach
    </select>
</form>

@if($classId && $subjectId)
<form method="POST" action="{{ route('admin.grades.store') }}" class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    @csrf
    <input type="hidden" name="subject_id" value="{{ $subjectId }}">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama Siswa</th>
                <th class="px-5 py-3">Tugas</th>
                <th class="px-5 py-3">UTS</th>
                <th class="px-5 py-3">UAS</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($students as $i => $student)
                @php($grade = $grades[$student->id] ?? null)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">
                        {{ $student->user->name }}
                        <input type="hidden" name="students[{{ $i }}][student_id]" value="{{ $student->id }}">
                    </td>
                    <td class="px-5 py-3"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][tugas]" value="{{ $grade->tugas ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200"></td>
                    <td class="px-5 py-3"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][uts]" value="{{ $grade->uts ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200"></td>
                    <td class="px-5 py-3"><input type="number" step="0.01" min="0" max="100" name="students[{{ $i }}][uas]" value="{{ $grade->uas ?? '' }}" class="w-24 px-3 py-2 rounded-lg border border-slate-200"></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5">
        <button class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan Nilai</button>
    </div>
</form>
@else
    <p class="text-slate-400 text-sm">Pilih kelas dan mata pelajaran untuk mulai input nilai.</p>
@endif
@endsection
