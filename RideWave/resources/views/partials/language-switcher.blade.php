<div class="inline-flex items-center rounded-xl border border-slate-200 bg-white p-1 text-xs font-bold uppercase tracking-[0.16em] text-slate-500">
    <a class="rounded-lg px-2 py-1 transition {{ app()->getLocale() === 'en' ? 'bg-rose-50 text-rose-600' : 'hover:bg-slate-50' }}" href="{{ route('locale.switch', ['locale' => 'en']) }}">EN</a>
    <a class="rounded-lg px-2 py-1 transition {{ app()->getLocale() === 'fr' ? 'bg-rose-50 text-rose-600' : 'hover:bg-slate-50' }}" href="{{ route('locale.switch', ['locale' => 'fr']) }}">FR</a>
</div>
