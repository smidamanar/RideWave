@php
    $driver = auth()->user();
    $avatarTheme = $driver->avatarTheme();
@endphp
<div class="relative group">
    <div class="flex items-center gap-3 cursor-pointer">
        <div class="flex flex-col items-end hidden sm:flex">
            <span class="text-sm font-bold text-slate-900 dark:text-white leading-none mb-1">{{ auth()->user()->name }}</span>
            <span class="px-2 py-0.5 rounded-full bg-primary/10 text-primary text-[10px] font-bold uppercase tracking-wider leading-none">{{ __('ui.pro_driver') }}</span>
        </div>
        <div class="w-10 h-10 rounded-full bg-slate-100 overflow-hidden border-2 border-white shadow-sm active:scale-95 transition-transform">
            @if ($driver->profile_photo_path)
                <img alt="Driver profile" class="h-full w-full object-cover" src="{{ route('driver.profile.photo') }}"/>
            @else
                <div class="flex h-full w-full items-center justify-center text-sm font-black text-white" style="background: {{ $avatarTheme['gradient'] }};">
                    {{ $driver->profileInitial() }}
                </div>
            @endif
        </div>
    </div>
    <div class="absolute right-0 top-full hidden pt-3 group-hover:block group-focus-within:block">
        <div class="min-w-[220px] overflow-hidden rounded-2xl border border-slate-100 bg-white shadow-[0_16px_40px_-16px_rgba(15,23,42,0.25)]">
            <a class="block px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50" href="{{ route('driver.history') }}">{{ __('ui.history') }}</a>
            <a class="block px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50" href="{{ route('driver.dashboard') }}">{{ __('ui.dashboard') }}</a>
            <a class="block px-5 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50" href="{{ route('driver.profile.edit') }}">{{ __('ui.manage_profile') }}</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="block w-full px-5 py-3 text-left text-sm font-semibold text-rose-600 hover:bg-rose-50" type="submit">{{ __('ui.logout') }}</button>
            </form>
        </div>
    </div>
</div>
