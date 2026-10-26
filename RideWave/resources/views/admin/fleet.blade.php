@extends('admin.layouts.ridewave')

@section('title', 'Fleet Status | RideWave Admin Portal')

@section('content')
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-headline-md font-headline-md text-slate-900">Fleet Status</h2>
        <p class="text-slate-500 mt-1">Vehicle inventory, fleet health, and driver ownership across the platform.</p>
    </div>
    <form action="{{ route('admin.fleet') }}" class="flex gap-3" method="GET">
        <input class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="q" placeholder="Search fleet..." type="text" value="{{ $query }}"/>
        <select class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="type">
            <option value="">All types</option>
            @foreach (['Electric', 'SUV', 'Sedan', 'Luxury'] as $option)
                <option @selected($type === $option) value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
        <button class="px-5 py-2.5 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200" type="submit">Apply</button>
    </form>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
    @forelse ($vehicles as $vehicle)
        <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
            <div class="flex justify-between items-start mb-4">
                <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-500">
                    <span class="material-symbols-outlined">{{ $vehicle['icon'] }}</span>
                </div>
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight {{ $vehicle['health']['class'] }}">{{ $vehicle['health']['label'] }}</span>
            </div>
            <h3 class="text-xl font-black text-slate-900">{{ $vehicle['brand'] }} {{ $vehicle['model'] }}</h3>
            <p class="text-sm text-slate-500 mt-1">{{ $vehicle['owner'] }}</p>
            <div class="mt-4 flex flex-wrap gap-2">
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight {{ $vehicle['type_class'] }}">{{ $vehicle['type'] }}</span>
                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight bg-slate-100 text-slate-600">{{ $vehicle['plate'] }}</span>
            </div>
            <div class="mt-5 space-y-2 text-sm text-slate-500">
                <div class="flex justify-between"><span>Year</span><span class="font-bold text-slate-900">{{ $vehicle['year'] }}</span></div>
                <div class="flex justify-between"><span>Color</span><span class="font-bold text-slate-900">{{ $vehicle['color'] }}</span></div>
                <div class="flex justify-between"><span>Seats</span><span class="font-bold text-slate-900">{{ $vehicle['seats'] }}</span></div>
            </div>
        </div>
    @empty
        <div class="md:col-span-3 bg-white p-10 rounded-2xl border border-slate-100 soft-elevation text-center text-slate-500">No vehicles matched the current filters.</div>
    @endforelse
</section>
@endsection
