@extends('admin.layouts.ridewave')

@section('title', 'Analytics | RideWave Admin Portal')

@section('content')
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-headline-md font-headline-md text-slate-900">Analytics</h2>
        <p class="text-slate-500 mt-1">The strongest routes, drivers, and booking behavior across the RideWave network.</p>
    </div>
    <a class="flex items-center gap-2 px-5 py-2.5 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200 active:scale-95 transition-all" href="{{ route('admin.reports.export') }}">
        <span class="material-symbols-outlined text-lg">download</span>
        Export Report
    </a>
</section>

<section class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Revenue</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">${{ number_format($stats['monthly_revenue'], 2) }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Reservations</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['reservations'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Validated Rides</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['validated_rides'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Completion</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ number_format($stats['completion_rate'], 1) }}%</h3>
    </div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Top Drivers</h4>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse ($topDrivers as $driver)
                <div class="px-6 py-4 flex items-center justify-between gap-4">
                    <div class="flex items-center gap-3">
                        <img alt="Driver" class="w-10 h-10 rounded-full" src="{{ $driver['avatar'] }}"/>
                        <div>
                            <p class="text-sm font-bold text-slate-900">{{ $driver['name'] }}</p>
                            <p class="text-[11px] text-slate-500">{{ $driver['rides'] }} rides · {{ $driver['confirmed_seats'] }} confirmed seats</p>
                        </div>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-amber-50 text-amber-600 text-[10px] font-extrabold uppercase tracking-tight">★ {{ $driver['rating'] }}</div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-slate-500">No driver analytics available yet.</div>
            @endforelse
        </div>
    </section>

    <section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Top Routes</h4>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse ($topRoutes as $route)
                <div class="px-6 py-4 flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $route['route'] }}</p>
                        <p class="text-[11px] text-slate-500">Recurring route demand across the network</p>
                    </div>
                    <div class="px-3 py-1 rounded-full bg-rose-50 text-rose-600 text-[10px] font-extrabold uppercase tracking-tight">{{ $route['count'] }} trips</div>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-slate-500">No route analytics available yet.</div>
            @endforelse
        </div>
    </section>
</div>
@endsection
