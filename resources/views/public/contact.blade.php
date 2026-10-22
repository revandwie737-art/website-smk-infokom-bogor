@extends('layouts.public')
@section('content')
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20 relative overflow-hidden">
    <div class="blob absolute top-0 right-0 w-72 h-72 rounded-full bg-sky-200/30 blur-3xl pointer-events-none"></div>
    <div class="text-center max-w-2xl mx-auto mb-14 relative" data-aos="fade-up">
        <span class="text-sky-600 font-semibold text-sm">Kontak</span>
        <h1 class="text-3xl md:text-4xl font-extrabold text-navy-900 mt-2">Hubungi Kami</h1>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 relative">
        <div data-aos="fade-right" class="space-y-4">
            <div class="hover-lift flex items-start gap-4 p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                <div class="h-11 w-11 rounded-xl bg-white grid place-items-center text-lg shadow-sm shrink-0">📍</div>
                <div>
                    <p class="font-semibold text-navy-800 mb-1">Alamat</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('address') }}</p>
                </div>
            </div>
            <div class="hover-lift flex items-start gap-4 p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                <div class="h-11 w-11 rounded-xl bg-white grid place-items-center text-lg shadow-sm shrink-0">☎️</div>
                <div>
                    <p class="font-semibold text-navy-800 mb-1">Telepon</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('phone') }}</p>
                </div>
            </div>
            <div class="hover-lift flex items-start gap-4 p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                <div class="h-11 w-11 rounded-xl bg-white grid place-items-center text-lg shadow-sm shrink-0">✉️</div>
                <div>
                    <p class="font-semibold text-navy-800 mb-1">Email</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('email') }}</p>
                </div>
            </div>
            @if(App\Models\SchoolSetting::get('whatsapp'))
            <div class="hover-lift flex items-start gap-4 p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                <div class="h-11 w-11 rounded-xl bg-white grid place-items-center text-lg shadow-sm shrink-0">💬</div>
                <div>
                    <p class="font-semibold text-navy-800 mb-1">WhatsApp</p>
                    <p class="text-sm text-slate-500">{{ App\Models\SchoolSetting::get('whatsapp') }}</p>
                </div>
            </div>
            @endif
            @if(App\Models\SchoolSetting::get('jam_operasional'))
            <div class="hover-lift flex items-start gap-4 p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                <div class="h-11 w-11 rounded-xl bg-white grid place-items-center text-lg shadow-sm shrink-0">🕐</div>
                <div>
                    <p class="font-semibold text-navy-800 mb-1">Jam Operasional</p>
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
                <div class="hover-lift p-5 rounded-2xl bg-navy-50 border border-slate-900/15">
                    <p class="font-semibold text-navy-800 mb-3">Ikuti Kami</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach($contactSocials as $label => $url)
                            @if($url)
                                <a href="{{ $url }}" target="_blank" rel="noopener" class="ripple-btn ripple-dark px-4 py-2 rounded-full bg-white border border-slate-900/15 text-sm font-medium text-navy-700 hover:bg-navy-700 hover:text-white transition">{{ $label }}</a>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="rounded-2xl overflow-hidden aspect-video border border-slate-900/15">
                <iframe class="w-full h-full" loading="lazy"
                    src="https://www.google.com/maps?q={{ App\Models\SchoolSetting::get('latitude') }},{{ App\Models\SchoolSetting::get('longitude') }}&output=embed"></iframe>
            </div>
        </div>

        <form method="POST" action="{{ route('contact.store') }}" data-aos="fade-left" class="space-y-5 h-fit bg-white p-7 rounded-3xl border border-slate-900/15 hover:shadow-xl transition-all duration-300">
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
            <button type="submit" class="ripple-btn magnetic-btn w-full py-3.5 rounded-xl bg-navy-700 text-white font-semibold hover:bg-navy-800 transition justify-center">
                Kirim Pesan
            </button>
        </form>
    </div>
</section>
@endsection
