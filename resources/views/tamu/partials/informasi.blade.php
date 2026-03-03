<section id="informasi" class="mt-8 grid gap-4 md:grid-cols-3">
    @foreach(($layanan ?? []) as $item)
        <article class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <h3 class="text-sm font-semibold uppercase tracking-wide text-slate-500">Informasi</h3>
            <p class="mt-2 text-sm text-slate-700">{{ $item }}</p>
        </article>
    @endforeach
</section>
