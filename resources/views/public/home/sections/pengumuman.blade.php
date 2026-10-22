<!-- PENGUMUMAN -->
@if($announcements->count())
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
    <div class="rounded-2xl bg-sky-50 border border-sky-100 p-6" data-aos="fade-up">
        <p class="font-semibold text-navy-800 mb-3">📢 Pengumuman Terbaru</p>
        <ul class="space-y-2">
            @foreach($announcements as $a)
                <li class="text-sm text-slate-600 flex gap-2">
                    <span class="text-sky-500">&bull;</span> {{ $a->title }}
                </li>
            @endforeach
        </ul>
    </div>
</section>
@endif