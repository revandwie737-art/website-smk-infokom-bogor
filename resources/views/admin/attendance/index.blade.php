@extends('layouts.admin')
@section('title', 'Input Kehadiran')
@section('content')
<form method="GET" class="flex flex-wrap gap-3 mb-6">
    <select name="class_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
        <option value="">Pilih Kelas</option>
        @foreach($classes as $c)
            <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
        @endforeach
    </select>
    <input type="date" name="date" value="{{ $date }}" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
</form>

@if($classId)
<form method="POST" action="{{ route('admin.attendance.store') }}" class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    @csrf
    <input type="hidden" name="date" value="{{ $date }}">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">Nama Siswa</th>
                <th class="px-5 py-3">Status Kehadiran</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @foreach($students as $i => $student)
                @php($att = $attendances[$student->id] ?? null)
                <tr>
                    <td class="px-5 py-3 font-medium text-slate-700">
                        {{ $student->user->name }}
                        <input type="hidden" name="students[{{ $i }}][student_id]" value="{{ $student->id }}">
                    </td>
                    <td class="px-5 py-3">
                        <select name="students[{{ $i }}][status]" class="px-3 py-2 rounded-lg border border-slate-200">
                            @foreach(['hadir'=>'Hadir','izin'=>'Izin','sakit'=>'Sakit','alpha'=>'Alpha'] as $val => $label)
                                <option value="{{ $val }}" @selected(($att->status ?? 'hadir') === $val)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="p-5">
        <button class="px-8 py-3 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800">Simpan Kehadiran</button>
    </div>
</form>
@else
    <p class="text-slate-400 text-sm">Pilih kelas untuk mulai input kehadiran.</p>
@endif
@endsection
