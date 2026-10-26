<header class="sticky top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-[0_10px_30px_-12px_rgba(248,46,110,0.10)]">
    <div class="flex justify-between items-center h-20 px-6 md:px-12 max-w-7xl mx-auto">
        <div class="flex items-center gap-8">
            <a class="text-2xl font-black bg-gradient-to-r from-[#F26D5D] to-[#F82E6E] bg-clip-text text-transparent tracking-tight" href="{{ route('passenger.home') }}">RideWave</a>
            <nav class="hidden md:flex gap-6 items-center">
                <a class="{{ ($active ?? '') === 'home' ? 'text-rose-500 font-bold' : 'text-slate-500 hover:text-rose-500' }} transition-colors font-semibold tracking-tight" href="{{ route('passenger.home') }}">{{ __('ui.home') }}</a>
                <a class="{{ ($active ?? '') === 'find-rides' ? 'text-rose-500 font-bold' : 'text-slate-500 hover:text-rose-500' }} transition-colors font-semibold tracking-tight" href="{{ route('passenger.find-rides') }}">{{ __('ui.find_rides') }}</a>
            </nav>
        </div>
        <div class="flex items-center gap-4">
            @include('partials.language-switcher')
            @include('partials.theme-toggle-button')
            @include('partials.notifications-menu')
            @include('passenger.partials.profile-menu')
        </div>
    </div>
</header>

