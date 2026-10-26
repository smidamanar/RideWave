@extends('admin.layouts.ridewave')

@section('title', 'Trip Validation | RideWave Admin Portal')

@section('content')
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-headline-md font-headline-md text-slate-900">Trip Validation</h2>
        <p class="text-slate-500 mt-1">Approve or re-queue live trips with database-backed validation status.</p>
    </div>
    <form action="{{ route('admin.trips') }}" class="flex gap-3" method="GET">
        <input class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="q" placeholder="Search trips..." type="text" value="{{ $query }}"/>
        <select class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="status">
            <option value="">All statuses</option>
            <option @selected($status === 'pending') value="pending">Pending</option>
            <option @selected($status === 'validated') value="validated">Validated</option>
        </select>
        <button class="px-5 py-2.5 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200" type="submit">Apply</button>
    </form>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">All Trips</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['rides'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Pending</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['pending_validations'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Validated</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['validated_rides'] }}</h3>
    </div>
</section>

<section class="space-y-4">
    @forelse ($rides as $ride)
        <div class="bg-white p-6 rounded-2xl border border-slate-100 soft-elevation">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
                <div class="space-y-2">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight {{ $ride['status']['class'] }}">{{ $ride['status']['label'] }}</span>
                        <span class="text-sm text-slate-400">Driver: {{ $ride['driver'] }}</span>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900">{{ $ride['route'] }}</h3>
                    <p class="text-sm text-slate-500">{{ $ride['date'] }} at {{ $ride['time'] }} · ${{ $ride['price'] }} · {{ $ride['bookings'] }} bookings · {{ $ride['seats'] }} seats left</p>
                </div>
                <div class="flex gap-3">
                    <a class="px-5 py-3 bg-slate-50 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-100 transition-all" href="{{ route('admin.search', ['q' => $ride['driver']]) }}">Review</a>
                    <form action="{{ route('admin.trips.toggle-validation', $ride['id']) }}" method="POST">
                        @csrf
                        <button class="px-5 py-3 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200 transition-all" type="submit">
                            {{ $ride['validated'] ? 'Move to Pending' : 'Validate Trip' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="bg-white p-10 rounded-2xl border border-slate-100 soft-elevation text-center text-slate-500">No trips matched the current filters.</div>
    @endforelse
</section>
@endsection
