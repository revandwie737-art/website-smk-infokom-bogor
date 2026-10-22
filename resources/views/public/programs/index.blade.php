```blade
@extends('layouts.public')

@section('content')

@php
    $set = fn($key, $default = null) => \App\Models\SchoolSetting::get($key, $default);
@endphp

<section class="relative overflow-hidden bg-gradient-to-b from-navy-50 via-white to-white py-16">

    <div class="blob absolute -top-16 -right-16 w-72 h-72 rounded-full bg-sky-200/40 blur-3xl pointer-events-none"></div>

    <div class="blob-slow absolute bottom-0 -left-10 w-64 h-64 rounded-full bg-navy-100/40 blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">

        <div class="text-center max-w-2xl mx-auto mb-10" data-aos="fade-up">

            <span class="inline-block px-4 py-1.5 rounded-full badge-shimmer text-navy-700 text-xs font-semibold mb-4">
                {{ $set('programs_badge', 'Program Keahlian') }}
            </span>

            <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900">
                {{ $set('programs_title', 'Program Keahlian SMK Infokom Bogor') }}
            </h1>

            <p class="text-slate-500 mt-4">
                {{ $set('programs_subtitle', 'Empat program keahlian yang dirancang sesuai kebutuhan industri kreatif dan teknologi.') }}
            </p>

        </div>

        <div class="space-y-4 md:space-y-6 max-w-5xl mx-auto">

            @foreach($programs as $i => $program)

                @php
                    $reverse = $i % 2 === 1;
                @endphp

                <a
                    href="{{ route('programs.show', $program->slug) }}"
                    data-aos="fade-up"
                    data-aos-delay="{{ $i * 80 }}"
                    class="tilt-hover group grid md:grid-cols-2 items-stretch rounded-2xl bg-white border border-slate-900/15 overflow-hidden hover:shadow-2xl hover:shadow-navy-100 transition-all duration-300"
                >

                    <div
                        class="reveal-mask tilt-3d relative aspect-video md:aspect-auto md:max-h-[220px] bg-slate-50 flex items-center justify-center p-6 {{ $reverse ? 'md:order-2' : '' }}"
                        data-tilt-strength="7"
                        data-tilt-scale="1.04"
                    >

                        @if($program->photo)

                            <img
                                src="{{ asset('storage/' . $program->photo) }}"
                                class="reveal-img max-w-full max-h-full object-contain"
                                alt="{{ $program->name }}"
                            >

                        @else

                            <div class="w-full h-full min-h-[160px] bg-navy-50 grid place-items-center text-navy-300 font-bold text-3xl">
                                {{ $program->code }}
                            </div>

                        @endif

                    </div>

                    <div class="p-5 md:p-7 flex flex-col justify-center {{ $reverse ? 'md:order-1' : '' }}">

                        @if($program->logo)

                            <div class="h-10 w-10 rounded-lg bg-white ring-1 ring-slate-900/10 grid place-items-center overflow-hidden p-1 shadow-sm mb-3">

                                <img
                                    src="{{ asset('storage/' . $program->logo) }}"
                                    class="w-full h-full object-contain"
                                    alt="{{ $program->name }}"
                                >

                            </div>

                        @else

                            <span class="inline-block w-fit px-3 py-1 rounded-full bg-sky-50 text-sky-600 text-xs font-semibold mb-3">
                                {{ $program->code }}
                            </span>

                        @endif

                        <p class="font-bold text-lg md:text-xl text-navy-800">
                            {{ $program->name }}
                        </p>

                        <p class="text-slate-500 text-sm mt-2 leading-relaxed line-clamp-3">
                            {{ $program->description }}
                        </p>

                        <span class="inline-flex items-center gap-1 text-navy-700 font-semibold text-xs md:text-sm mt-4 group-hover:gap-2.5 transition-all w-fit">
                            Lihat Detail &rarr;
                        </span>

                    </div>

                </a>

            @endforeach

        </div>

    </div>

</section>

@endsection
```
