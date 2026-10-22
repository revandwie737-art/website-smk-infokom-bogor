@extends('layouts.admin')
@section('title', 'Struktur Organisasi')
@section('content')
<div class="flex justify-between items-center mb-6">
    <p class="text-sm text-slate-400 max-w-xl">Kelola nama & jabatan yang tampil di bagan "Struktur Organisasi Sekolah" pada halaman Guru. Nama Kepala Sekolah diatur terpisah di menu Pengaturan Website &rarr; tab Tentang &amp; Kepala Sekolah.</p>
    <a href="{{ route('admin.structure.create') }}" class="shrink-0 px-5 py-2.5 rounded-xl bg-navy-700 text-white text-sm font-semibold hover:bg-navy-800">+ Tambah Anggota</a>
</div>

@foreach(\App\Models\StructureMember::SECTIONS as $key => $label)
    <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden mb-6">
        <div class="px-5 py-3 border-b border-slate-100 bg-slate-50">
            <p class="font-semibold text-navy-800 text-sm">{{ $label }}</p>
        </div>
        <table class="w-full text-sm">
            <tbody class="divide-y divide-slate-100">
                @if($key !== 'staff')
                    @forelse($members->get($key, collect()) as $m)
                        <tr>
                            <td class="px-5 py-3 font-medium text-slate-700">{{ $m->name }}</td>
                            <td class="px-5 py-3 text-slate-500">{{ $m->role }}</td>
                            <td class="px-5 py-3 w-32">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.structure.edit', $m) }}" class="text-sky-600 font-medium">Edit</a>
                                    <form method="POST" action="{{ route('admin.structure.destroy', $m) }}" onsubmit="return confirm('Hapus anggota ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-500 font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-slate-400">Belum ada data.</td></tr>
                    @endforelse
                @else
                    @php $staffGroups = $members->filter(fn($v, $k) => str_starts_with($k, 'staff:')); @endphp
                    @forelse($staffGroups as $groupKey => $groupMembers)
                        @foreach($groupMembers as $m)
                            <tr>
                                <td class="px-5 py-3 text-xs text-slate-400 w-40">{{ $m->group_label }}</td>
                                <td class="px-5 py-3 font-medium text-slate-700">{{ $m->name }}</td>
                                <td class="px-5 py-3 w-32">
                                    <div class="flex gap-3">
                                        <a href="{{ route('admin.structure.edit', $m) }}" class="text-sky-600 font-medium">Edit</a>
                                        <form method="POST" action="{{ route('admin.structure.destroy', $m) }}" onsubmit="return confirm('Hapus anggota ini?')">
                                            @csrf @method('DELETE')
                                            <button class="text-red-500 font-medium">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @empty
                        <tr><td colspan="3" class="px-5 py-6 text-center text-slate-400">Belum ada data.</td></tr>
                    @endforelse
                @endif
            </tbody>
        </table>
    </div>
@endforeach
@endsection