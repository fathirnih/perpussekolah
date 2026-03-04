@php
    $size = $size ?? 'h-10 w-10';
    $rounded = $rounded ?? 'rounded-full';
    $logoCandidates = [
        ['path' => public_path('images/logo-sekolah.png'), 'asset' => asset('images/logo-sekolah.png')],
        ['path' => public_path('images/logo-sekolah.jpeg'), 'asset' => asset('images/logo-sekolah.jpeg')],
        ['path' => public_path('images/logo-sekolah.jpg'), 'asset' => asset('images/logo-sekolah.jpg')],
        ['path' => public_path('images/logo-sekolah.webp'), 'asset' => asset('images/logo-sekolah.webp')],
    ];
    $logo = collect($logoCandidates)->first(fn ($item) => file_exists($item['path']));
@endphp

@if($logo)
    <img src="{{ $logo['asset'] }}" alt="Logo SMK Negeri 2 Padang Panjang" class="{{ $size }} {{ $rounded }} object-cover">
@else
    <div class="{{ $size }} {{ $rounded }} flex items-center justify-center bg-sky-100 text-[11px] font-black text-sky-700">
        SMKN2
    </div>
@endif
