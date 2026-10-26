@extends('admin.layouts.ridewave')

@section('title', 'Search | RideWave Admin Portal')

@section('content')
<section>
    <h2 class="text-headline-md font-headline-md text-slate-900">Search Results</h2>
    <p class="text-slate-500 mt-1">Query: <span class="font-bold text-rose-600">{{ $query !== '' ? $query : 'empty search' }}</span></p>
</section>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Users</h4>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse ($users as $user)
                <div class="px-6 py-4">
                    <p class="text-sm font-bold text-slate-900">{{ $user->name }}</p>
                    <p class="text-[11px] text-slate-500">{{ $user->email }}</p>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-slate-500">No matching users.</div>
            @endforelse
        </div>
    </section>

    <section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Trips</h4>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse ($rides as $ride)
                <div class="px-6 py-4">
                    <p class="text-sm font-bold text-slate-900">{{ $ride->depart }} → {{ $ride->destination }}</p>
                    <p class="text-[11px] text-slate-500">{{ $ride->conducteur->name ?? 'Unknown driver' }} · {{ $ride->date->format('M d, Y') }}</p>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-slate-500">No matching trips.</div>
            @endforelse
        </div>
    </section>

    <section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Fleet</h4>
        </div>
        <div class="divide-y divide-slate-50">
            @forelse ($vehicles as $vehicle)
                <div class="px-6 py-4">
                    <p class="text-sm font-bold text-slate-900">{{ $vehicle->marque }} {{ $vehicle->modele }}</p>
                    <p class="text-[11px] text-slate-500">{{ $vehicle->immatriculation }} · {{ $vehicle->user->name ?? 'Unknown driver' }}</p>
                </div>
            @empty
                <div class="px-6 py-10 text-center text-slate-500">No matching vehicles.</div>
            @endforelse
        </div>
    </section>
</div>
@endsection
