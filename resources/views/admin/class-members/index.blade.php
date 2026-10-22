@extends('layouts.admin')
@section('title', 'Pengurus / Anggota Kelas')
@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <form method="GET" class="flex gap-2">
        <select name="class_id" onchange="this.form.submit()" class="px-4 py-2.5 rounded-xl border border-slate-200 text-sm">
            <option value="">Pilih Kelas</option>
            @foreach($classes as $c)
                <option value="{{ $c->id }}" @selected($classId == $c->id)>{{ $c->name }}</option>
            @endforeach
        </select>
    </form>
    @if($classId)
        <a href="{{ route('admin.class-members.create', ['class_id' => $classId]) }}" class="px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Anggota</a>
    @endif
</div>

<p class="text-sm text-slate-400 mb-4">Data ini murni untuk ditampilkan sebagai daftar teman sekelas di Portal Siswa &amp; dashboard admin — bukan akun login. Untuk akun siswa yang bisa login, gunakan menu Siswa.</p>

<div class="bg-white rounded-2xl border border-slate-100 overflow-x-auto">
    <table class="w-full text-sm">
        <thead>
            <tr class="text-left text-slate-400 border-b border-slate-100">
                <th class="px-5 py-3">No.</th>
                <th class="px-5 py-3">Nama</th>
                <th class="px-5 py-3">Peran</th>
                <th class="px-5 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
            @forelse($members as $i => $member)
                <tr>
                    <td class="px-5 py-3 text-slate-400">{{ $i + 1 }}</td>
                    <td class="px-5 py-3 font-medium text-slate-700">{{ $member->name }}</td>
                    <td class="px-5 py-3 text-slate-500">{{ $member->role }}</td>
                    <td class="px-5 py-3">
                        <div class="flex gap-3">
                            <a href="{{ route('admin.class-members.edit', $member) }}" class="text-sky-600 font-medium">Edit</a>
                            <form method="POST" action="{{ route('admin.class-members.destroy', $member) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-500 font-medium">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="px-5 py-8 text-center text-slate-400">{{ $classId ? 'Belum ada anggota untuk kelas ini.' : 'Pilih kelas terlebih dahulu.' }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
