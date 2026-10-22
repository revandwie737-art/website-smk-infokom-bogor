@props(['action', 'label' => 'Hapus', 'confirm' => 'Apakah Anda yakin ingin menghapus data ini?', 'method' => 'DELETE'])
<form method="POST" action="{{ $action }}" onsubmit="return confirm('{{ $confirm }}')">
    @csrf
    @if(strtoupper($method) !== 'POST') @method($method) @endif
    <button type="submit" title="{{ $label }}" class="inline-flex items-center justify-center h-8 w-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition">
        <i data-lucide="trash-2" class="w-[15px] h-[15px]"></i>
    </button>
</form>
