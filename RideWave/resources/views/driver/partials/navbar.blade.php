<header class="sticky top-0 z-50 border-b border-white/70 bg-white/85 backdrop-blur-xl">
    <div class="mx-auto flex max-w-screen-2xl items-center justify-between px-6 py-4 lg:px-8">
        <div class="flex items-center gap-8">
            <a class="bg-gradient-to-r from-[#f26d5d] to-[#f82e6e] bg-clip-text text-2xl font-black tracking-tight text-transparent" href="{{ route('driver.home') }}">RideWave</a>
            <nav class="hidden items-center gap-6 md:flex">
                <a class="text-sm font-semibold {{ ($active ?? '') === 'home' ? 'text-slate-900' : 'text-slate-500 transition hover:text-slate-900' }}" href="{{ route('driver.home') }}">{{ __('ui.home') }}</a>
                <a class="text-sm font-semibold {{ ($active ?? '') === 'find-rides' ? 'text-slate-900' : 'text-slate-500 transition hover:text-slate-900' }}" href="{{ route('driver.find-rides') }}">{{ __('ui.find_rides') }}</a>
                <a class="text-sm font-semibold {{ ($active ?? '') === 'offer-ride' ? 'text-slate-900' : 'text-slate-500 transition hover:text-slate-900' }}" href="{{ route('driver.offer-ride.create') }}">{{ __('ui.offer_ride') }}</a>
                <a class="text-sm font-semibold {{ ($active ?? '') === 'fleet' ? 'text-slate-900' : 'text-slate-500 transition hover:text-slate-900' }}" href="{{ route('driver.fleet') }}">{{ __('ui.fleet') }}</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            @if (!($hideThemeToggle ?? false))
                @include('partials.language-switcher')
            @include('partials.theme-toggle-button')
            @endif
            @include('partials.notifications-menu')
            @include('driver.partials.profile-menu')
        </div>
    </div>
</header>

