@extends('layouts.public')
@section('content')
@php
    $set = fn($key, $default = null) => App\Models\SchoolSetting::get($key, $default);
    // Urutan, tampil/sembunyi, dan ukuran tiap bagian diatur di admin: Tata Letak Beranda.
    $homeSections = \App\Models\HomeSection::forHome();
@endphp

<style>
    /* Pengaturan ukuran per bagian (dari admin). Bawaan = tidak mengubah apa pun. */
    .hs { padding-top: var(--hs-pt, 0); padding-bottom: var(--hs-pb, 0); }
    .hs[data-width="narrow"] .max-w-7xl { max-width: 64rem; }
    .hs[data-width="wide"] .max-w-7xl { max-width: 90rem; }
    .hs[data-width="full"] .max-w-7xl { max-width: none; }
    .hs[data-title] h2 { zoom: var(--hs-title, 1); }
</style>

@foreach($homeSections as $hs)
    @if($hs->is_visible)
        <div class="hs" data-home-section="{{ $hs->key }}" {!! $hs->dataAttributes() !!} @if($hs->inlineStyle()) style="{{ $hs->inlineStyle() }}" @endif>
            @include('public.home.sections.' . $hs->key)
        </div>
    @endif
@endforeach
@endsection