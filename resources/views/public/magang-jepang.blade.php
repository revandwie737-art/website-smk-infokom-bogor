@extends('layouts.public')
@section('content')

{{-- Tandai JS aktif SEBELUM elemen dirender: helper animasi baru menyembunyikan konten kalau JS jalan --}}
<script>document.documentElement.classList.add('mj-js');</script>
<link rel="stylesheet" href="{{ asset('css/magang-jepang.css') }}">

@php
    $img = fn ($file) => asset('images/magang-jepang/' . $file);
    $kanji = ['壱', '弐', '参'];
    $goalKanji = ['一', '二', '三', '四', '五', '六', '七', '八', '九', '十'];
    $paragraphs = fn ($text) => preg_split('/\R{2,}/', trim((string) $text)) ?: [];

    $intro = $texts['intro'] ?? null;
    $alumni = $texts['alumni'] ?? null;
    $closing = $texts['closing'] ?? null;

    // Jalur perjalanan = foto dokumentasi + catatan tambahan dari admin, diurut menurut sort_order.
    $trail = collect();
    foreach ($japanInternships as $photo) {
        $trail->push(['sort' => $photo->sort_order, 'label' => null, 'title' => $photo->title, 'description' => $photo->description]);
    }
    foreach ($steps as $step) {
        $trail->push(['sort' => $step->sort_order, 'label' => $step->label, 'title' => $step->title, 'description' => $step->description]);
    }
    $trail = $trail->sortBy('sort')->values();
@endphp

<div class="mj-page">
    <div class="mj-paper" aria-hidden="true"></div>
    <img class="mj-ink mj-ink--a" src="{{ $img('ink-wash.webp') }}" alt="" aria-hidden="true">
    <img class="mj-ink mj-ink--b" src="{{ $img('ink-wash.webp') }}" alt="" aria-hidden="true">

    {{-- Kelopak sakura: dibuat oleh JS, memenuhi seluruh tinggi halaman sampai sebelum footer --}}
    <div class="mj-petals" data-mj-petals aria-hidden="true"></div>

    <div class="mj-top">
    {{-- Dekorasi tepi kiri-kanan (disembunyikan otomatis di layar sempit) --}}
    <div class="mj-deco mj-deco--cloud-red" aria-hidden="true"><img src="{{ $img('cloud-red.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--sakura-tl" aria-hidden="true"><img src="{{ $img('sakura-tl.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--sakura-tr" aria-hidden="true"><img src="{{ $img('sakura.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--pagoda" aria-hidden="true"><img src="{{ $img('pagoda.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--cloud-a" aria-hidden="true"><img src="{{ $img('cloud-teal.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--cloud-b" aria-hidden="true"><img src="{{ $img('cloud-teal.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--plum" aria-hidden="true"><img src="{{ $img('plum-torii.webp') }}" alt=""></div>
    <div class="mj-deco mj-deco--cloud-c" aria-hidden="true"><img src="{{ $img('cloud-teal.webp') }}" alt=""></div>

    {{-- ====================== HERO ====================== --}}
    <header class="mj-hero">
        <div class="mj-hero-inner">
            <div class="mj-hero-text">
                <span class="mj-vkanji" aria-hidden="true">日本</span>
                <p class="mj-badge">Dokumentasi Alumni</p>
                <h1 class="mj-title"><span class="mj-text-reveal" data-mj-reveal><span>Magang Jepang</span></span></h1>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="250"></i>
                @if($intro && trim($intro->body))
                    <p class="mj-lead mj-fade" data-mj-reveal data-mj-delay="400">{{ $intro->body }}</p>
                @endif
            </div>

            <div class="mj-hero-art" aria-hidden="true">
                <img class="mj-art-sun" src="{{ $img('sun-brush.webp') }}" alt="">
                <img class="mj-art-castle" src="{{ $img('castle.webp') }}" alt="">
                <img class="mj-art-japan" src="{{ $img('japan-flag.webp') }}" alt="">
            </div>
        </div>
    </header>

    {{-- ====================== TIGA FOTO (data dari database) ====================== --}}
    <section class="mj-stage" aria-label="Foto Magang Jepang">
        @forelse($japanInternships as $i => $item)
            <article class="japan-internship-item mj-item" data-mj-item>
                <div data-parallax="{{ [0.06, -0.045, 0.1][$i] ?? 0.05 }}">

                    <div class="mj-index">
                        <span class="mj-kanji mj-fade" data-mj-reveal data-mj-delay="{{ $i * 140 }}" aria-hidden="true">{{ $kanji[$i] ?? '' }}</span>
                        <span class="mj-num mj-fade" data-mj-reveal data-mj-delay="{{ $i * 140 + 80 }}">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <i class="mj-rule" data-mj-reveal data-mj-delay="{{ $i * 140 + 160 }}"></i>
                    </div>

                    <div class="mj-mount">
                        <div class="mj-frame mj-wipe mj-zoom-scope" data-mj-reveal data-mj-delay="{{ $i * 160 }}">

                            {{-- Klik foto → penampil foto layar penuh bawaan situs (cinematic lightbox) --}}
                            <div class="mj-photo"
                                 role="button" tabindex="0" aria-label="Perbesar foto: {{ $item->title }}"
                                 data-lightbox-src="{{ $item->image_url }}"
                                 data-lightbox-caption="{{ $item->title }}"
                                 data-lightbox-desc="{{ $item->description }}"
                                 @if($item->source_name) data-lightbox-meta="Sumber: {{ $item->source_name }}" @endif>
                                <img class="mj-zoom" src="{{ $item->image_url }}" alt="{{ $item->title }}" loading="{{ $i === 0 ? 'eager' : 'lazy' }}">
                            </div>

                            <span class="mj-vlabel" aria-hidden="true">MAGANG JEPANG</span>

                            <button type="button" class="mj-toggle" data-mj-toggle aria-expanded="false">Deskripsi</button>

                            <div class="japan-internship-content mj-caption">
                                <h3>{{ $item->title }}</h3>
                                <div class="mj-more">
                                    <div>
                                        @if($item->description)
                                            <p>{{ $item->description }}</p>
                                        @endif

                                        @if($item->source_url)
                                            <a class="mj-source-link" href="{{ $item->source_url }}" target="_blank" rel="noopener noreferrer">
                                                {{ $item->source_name ?: 'Lihat Sumber' }}
                                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M7 17L17 7M9 7h8v8"/></svg>
                                            </a>
                                        @elseif($item->source_name)
                                            <span class="mj-source-link" style="pointer-events:none">{{ $item->source_name }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </article>
        @empty
            <p class="mj-empty">Foto Magang Jepang belum tersedia.</p>
        @endforelse
    </section>
    </div>{{-- /.mj-top --}}

    {{-- ====================== PROGRAM KHUSUS ALUMNI ====================== --}}
    @if($alumni && trim((string) $alumni->body))
        <section class="mj-wrap mj-sec mj-alumni" aria-labelledby="mj-alumni-title">
            <div class="mj-alumni-text">
                <div class="mj-sechead">
                    <span class="mj-hanko mj-fade" data-mj-reveal aria-hidden="true">卒</span>
                    <span class="mj-sekanji" aria-hidden="true">卒業生</span>
                </div>
                <h2 id="mj-alumni-title" class="mj-h2 mj-text-reveal" data-mj-reveal><span>{{ $alumni->title ?: 'Program Khusus Alumni' }}</span></h2>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="200"></i>
                @foreach($paragraphs($alumni->body) as $k => $para)
                    <p class="mj-p mj-rise" data-mj-reveal data-mj-delay="{{ 250 + $k * 120 }}">{{ $para }}</p>
                @endforeach
            </div>
            <div class="mj-alumni-art mj-fade" data-mj-reveal data-mj-delay="300" aria-hidden="true">
                <img src="{{ $img('sun-seal.webp') }}" alt="">
            </div>
        </section>
    @endif

    {{-- ====================== INFORMASI PROGRAM (tampil hanya jika admin mengisi) ====================== --}}
    @if($facts->isNotEmpty())
        <section class="mj-wrap mj-sec" aria-label="Informasi program">
            <dl class="mj-facts-grid">
                @foreach($facts as $i => $fact)
                    <div class="mj-fact mj-rise" data-mj-reveal data-mj-delay="{{ $i * 90 }}">
                        <dt>{{ $fact->label }}</dt>
                        <dd>{{ $fact->value }}</dd>
                    </div>
                @endforeach
            </dl>
        </section>
    @endif

    {{-- ====================== TUJUAN PROGRAM (tampil hanya jika ada yang aktif) ====================== --}}
    @if($goals->isNotEmpty())
        <section class="mj-wrap mj-sec mj-goals" aria-labelledby="mj-goals-title">
            <div class="mj-goals-head">
                <div class="mj-sechead">
                    <span class="mj-hanko mj-fade" data-mj-reveal aria-hidden="true">目</span>
                    <span class="mj-sekanji" aria-hidden="true">目的</span>
                </div>
                <h2 id="mj-goals-title" class="mj-h2 mj-text-reveal" data-mj-reveal><span>Tujuan Program</span></h2>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="200"></i>
            </div>

            <ol class="mj-goal-list">
                @foreach($goals as $i => $goal)
                    <li class="mj-goal mj-rise" data-mj-reveal data-mj-delay="{{ $i * 110 }}">
                        <span class="mj-goal-kanji" aria-hidden="true">{{ $goalKanji[$i] ?? $i + 1 }}</span>
                        <div>
                            <h3>{{ $goal->title }}</h3>
                            @if($goal->description)
                                <p>{{ $goal->description }}</p>
                            @endif
                        </div>
                        <span class="mj-goal-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </li>
                @endforeach
            </ol>
        </section>
    @endif

    {{-- ====================== ALUR MAGANG KE JEPANG (tampil hanya jika admin mengisi) ====================== --}}
    @if($flows->isNotEmpty())
        <section class="mj-wrap mj-sec" aria-labelledby="mj-flow-title">
            <div class="mj-flow-head">
                <div class="mj-sechead">
                    <span class="mj-hanko mj-fade" data-mj-reveal aria-hidden="true">流</span>
                    <span class="mj-sekanji" aria-hidden="true">流れ</span>
                </div>
                <h2 id="mj-flow-title" class="mj-h2 mj-text-reveal" data-mj-reveal><span>Alur Magang ke Jepang</span></h2>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="200"></i>
            </div>

            <ol class="mj-flow">
                @foreach($flows as $i => $flow)
                    <li class="mj-flow-step mj-rise" data-mj-reveal data-mj-delay="{{ ($i % 3) * 100 }}">
                        <span class="mj-flow-num" aria-hidden="true">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        @if($flow->label)
                            <p class="mj-flow-label">{{ $flow->label }}</p>
                        @endif
                        <h3>{{ $flow->title }}</h3>
                        @if($flow->description)
                            <p class="mj-flow-desc">{{ $flow->description }}</p>
                        @endif
                    </li>
                @endforeach
            </ol>
        </section>
    @endif

    {{-- ====================== PERJALANAN MAGANG JEPANG ====================== --}}
    @if($trail->isNotEmpty())
        <section class="mj-wrap mj-sec mj-trail-sec" aria-labelledby="mj-trail-title">
            {{-- Dekorasi tepi kiri-kanan bagian Perjalanan (tampil di layar >= 1280px) --}}
            <div class="mj-trail-deco" aria-hidden="true">
                <img class="mj-td mj-td-sakura" src="{{ $img('sakura-tl.webp') }}" alt="">
                <img class="mj-td mj-td-japan" src="{{ $img('japan-letters.webp') }}" alt="">
                <img class="mj-td mj-td-seal" src="{{ $img('sun-seal.webp') }}" alt="">

                <div class="mj-td mj-td-tokyo">
                    <img src="{{ $img('sun-brush.webp') }}" alt="">
                    <span>TOKYO</span>
                </div>
                <i class="mj-td mj-td-rule"></i>
                <img class="mj-td mj-td-koi" src="{{ $img('koi.webp') }}" alt="">
                <img class="mj-td mj-td-castle" src="{{ $img('castle.webp') }}" alt="">
                <img class="mj-td mj-td-cloud mj-td-cloud--1" src="{{ $img('cloud-ink.webp') }}" alt="">
                <img class="mj-td mj-td-cloud mj-td-cloud--2" src="{{ $img('cloud-ink.webp') }}" alt="">
                <img class="mj-td mj-td-cloud mj-td-cloud--3" src="{{ $img('cloud-ink.webp') }}" alt="">
            </div>

            <div class="mj-trail-head">
                <div class="mj-sechead">
                    <span class="mj-hanko mj-fade" data-mj-reveal aria-hidden="true">旅</span>
                    <span class="mj-sekanji" aria-hidden="true">旅</span>
                </div>
                <h2 id="mj-trail-title" class="mj-h2 mj-text-reveal" data-mj-reveal><span>Perjalanan Magang Jepang</span></h2>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="200"></i>
                <p class="mj-p mj-fade" data-mj-reveal data-mj-delay="300">Dokumentasi perjalanan alumni menuju Jepang dan pengalaman mereka di sana.</p>
            </div>

            <ol class="mj-trail">
                @foreach($trail as $i => $t)
                    <li class="mj-trail-item mj-rise" data-mj-reveal data-mj-delay="{{ ($i % 3) * 80 }}">
                        <span class="mj-trail-node" aria-hidden="true"></span>
                        <div class="mj-trail-card">
                            <p class="mj-trail-label">{{ $t['label'] ?: 'Momen ' . str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</p>
                            <h3>{{ $t['title'] }}</h3>
                            @if($t['description'])
                                <p class="mj-trail-desc">{{ $t['description'] }}</p>
                            @endif
                        </div>
                    </li>
                @endforeach
            </ol>
        </section>
    @endif

    {{-- ====================== PENGALAMAN YANG DIDAPAT (tampil hanya jika admin mengisi) ====================== --}}
    @if($experiences->isNotEmpty())
        <section class="mj-wrap mj-sec" aria-labelledby="mj-exp-title">
            <div class="mj-exp-head">
                <div class="mj-sechead">
                    <span class="mj-hanko mj-fade" data-mj-reveal aria-hidden="true">経</span>
                    <span class="mj-sekanji" aria-hidden="true">経験</span>
                </div>
                <h2 id="mj-exp-title" class="mj-h2 mj-text-reveal" data-mj-reveal><span>Pengalaman yang Didapat</span></h2>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="200"></i>
            </div>

            <ul class="mj-exp-grid">
                @foreach($experiences as $i => $exp)
                    <li class="mj-exp-card mj-rise" data-mj-reveal data-mj-delay="{{ ($i % 3) * 100 }}">
                        <span class="mj-hanko" aria-hidden="true">{{ $goalKanji[$i] ?? $i + 1 }}</span>
                        <h3>{{ $exp->title }}</h3>
                        @if($exp->description)
                            <p>{{ $exp->description }}</p>
                        @endif
                    </li>
                @endforeach
            </ul>
        </section>
    @endif

    {{-- ====================== PENUTUP (tanpa tombol) ====================== --}}
    @if($closing && trim((string) $closing->body))
        <section class="mj-closing" aria-label="Penutup">
            <img class="mj-sakura mj-sakura--tl" src="{{ $img('sakura.webp') }}" alt="" aria-hidden="true">
            <div class="mj-closing-inner">
                <span class="mj-hanko mj-hanko--lg mj-fade" data-mj-reveal aria-hidden="true">結</span>
                <p class="mj-closing-text mj-rise" data-mj-reveal data-mj-delay="150">{{ $closing->body }}</p>
                <i class="mj-redrule mj-fade" data-mj-reveal data-mj-delay="300"></i>
                <p class="mj-closing-mark mj-fade" data-mj-reveal data-mj-delay="400" aria-hidden="true">結び</p>
            </div>
        </section>
    @endif

    <img class="mj-ink mj-ink--c" src="{{ $img('ink-wash.webp') }}" alt="" aria-hidden="true">
</div>

@push('scripts')
<script src="{{ asset('js/magang-jepang.js') }}"></script>
@endpush
@endsection