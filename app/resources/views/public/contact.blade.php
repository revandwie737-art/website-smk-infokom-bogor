@extends('layouts.public')
@section('content')

<x-public.page-hero eyebrow="Kontak" title="Ada pertanyaan? Kami siap membantu." description="Hubungi kami langsung, atau kirim pesan lewat formulir di samping." />

<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6 pb-28">
    <div class="grid lg:grid-cols-2 gap-12">
        <div class="space-y-4" data-reveal="left">
            @php
                $contactItems = [
                    ['icon' => 'M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z|M15 11a3 3 0 11-6 0 3 3 0 016 0z', 'label' => 'Alamat', 'value' => App\Models\SchoolSetting::get('address')],
                    ['icon' => 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z', 'label' => 'Telepon', 'value' => App\Models\SchoolSetting::get('phone')],
                    ['icon' => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z', 'label' => 'Email', 'value' => App\Models\SchoolSetting::get('email')],
                ];
            @endphp
            @foreach($contactItems as $i => $item)
                @if($item['value'])
                <div data-reveal data-reveal-delay="{{ $i }}" class="flex items-start gap-4 p-6 rounded-[1.5rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-lg hover:shadow-navy-900/[0.05] transition-all">
                    <div class="h-11 w-11 rounded-xl bg-navy-50 text-navy-700 grid place-items-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            @foreach(explode('|', $item['icon']) as $path)
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="{{ $path }}"/>
                            @endforeach
                        </svg>
                    </div>
                    <div>
                        <p class="font-semibold text-navy-900 mb-1">{{ $item['label'] }}</p>
                        <p class="text-sm text-slate-500">{{ $item['value'] }}</p>
                    </div>
                </div>
                @endif
            @endforeach

            @if(App\Models\SchoolSetting::get('whatsapp'))
            <div data-reveal class="flex items-start gap-4 p-6 rounded-[1.5rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-lg hover:shadow-navy-900/[0.05] transition-all">
                <div class="h-11 w-11 rounded-xl bg-emerald-50 text-emerald-600 grid place-items-center shrink-0"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.5 14.4c-.3-.1-1.7-.8-2-1-.3-.1-.5-.1-.6.1-.2.3-.7 1-.9 1.2-.2.2-.3.2-.6.1a8 8 0 01-2.3-1.4 8.6 8.6 0 01-1.6-2c-.2-.3 0-.5.1-.6l.4-.5.3-.4c.1-.2 0-.3 0-.5l-1-2.2c-.2-.5-.4-.4-.6-.4h-.5c-.2 0-.5.1-.7.3C7 7.4 6.4 8 6.4 9.4c0 1.4 1 2.7 1.1 2.9.1.2 2 3.1 4.9 4.3.7.3 1.2.5 1.6.6.7.2 1.3.2 1.8.1.5-.1 1.7-.7 2-1.4.2-.6.2-1.2.2-1.3-.1-.1-.3-.2-.5-.3zM12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2z"/></svg></div>
                <div>
                    <p class="font-semibold text-navy-900 mb-1">WhatsApp</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('whatsapp') }}</p>
                </div>
            </div>
            @endif

            @if(App\Models\SchoolSetting::get('jam_operasional'))
            <div data-reveal class="flex items-start gap-4 p-6 rounded-[1.5rem] bg-white border border-slate-200 hover:border-navy-300 hover:shadow-lg hover:shadow-navy-900/[0.05] transition-all">
                <div class="h-11 w-11 rounded-xl bg-gold-50 text-gold-500 grid place-items-center shrink-0"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
                <div>
                    <p class="font-semibold text-navy-900 mb-1">Jam Operasional</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('jam_operasional') }}</p>
                </div>
            </div>
            @endif

            @php
                $contactSocials = [
                    'Facebook' => App\Models\SchoolSetting::get('facebook'),
                    'Instagram' => App\Models\SchoolSetting::get('instagram'),
                    'YouTube' => App\Models\SchoolSetting::get('youtube'),
                ];
            @endphp
            @if(collect($contactSocials)->filter()->isNotEmpty())
                <div data-reveal class="p-6 rounded-[1.5rem] bg-white border border-slate-200">
                    <p class="font-semibold text-navy-900 mb-3">Ikuti Kami</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($contactSocials as $label => $url)
                            @if($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener" data-cursor-hover class="px-4 py-2 rounded-full bg-slate-50 border border-slate-200 text-sm font-medium text-navy-700 hover:bg-navy-900 hover:text-white hover:border-navy-900 transition">{{ $label }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif

            <div data-reveal class="rounded-[1.5rem] overflow-hidden aspect-video border border-slate-200">
                <iframe class="w-full h-full" loading="lazy"
                    src="https://www.google.com/maps?q={{ App\Models\SchoolSetting::get('latitude') }},{{ App\Models\SchoolSetting::get('longitude') }}&output=embed"></iframe>
            </div>
        </div>

        <form method="POST" action="{{ route('contact.store') }}" data-reveal="right" class="space-y-5 h-fit bg-white p-8 rounded-[1.75rem] border border-slate-200 shadow-sm">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Nama</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Subjek</label>
                <input type="text" name="subject" value="{{ old('subject') }}" class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-1.5">Pesan</label>
                <textarea name="message" rows="5" required class="w-full px-4 py-2.5 rounded-xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-300">{{ old('message') }}</textarea>
            </div>
            <button type="submit" data-cursor-hover class="magnetic w-full py-3.5 rounded-xl bg-navy-900 text-white font-semibold hover:bg-navy-800 transition shadow-lg shadow-navy-900/15">
                Kirim Pesan
            </button>
        </form>
    </div>
</section>
@endsection
