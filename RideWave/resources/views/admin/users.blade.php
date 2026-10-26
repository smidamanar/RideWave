@extends('admin.layouts.ridewave')

@section('title', 'User Moderation | RideWave Admin Portal')

@section('content')
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-headline-md font-headline-md text-slate-900">User Moderation</h2>
        <p class="text-slate-500 mt-1">Search, review, and monitor the people driving the <span class="font-bold text-rose-600">RideWave</span> ecosystem.</p>
    </div>
    <form action="{{ route('admin.users') }}" class="flex gap-3" method="GET">
        <input class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="q" placeholder="Search users..." type="text" value="{{ $query }}"/>
        <select class="px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-rose-500/20 transition-all" name="role">
            <option value="">All roles</option>
            <option @selected($role === 'admin') value="admin">Admin</option>
            <option @selected($role === 'conducteur') value="conducteur">Driver</option>
            <option @selected($role === 'passager') value="passager">Passenger</option>
        </select>
        <button class="px-5 py-2.5 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200" type="submit">Apply</button>
    </form>
</section>

<section class="grid grid-cols-1 md:grid-cols-4 gap-6">
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Total Users</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['users'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Drivers</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['drivers'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Passengers</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['passengers'] }}</h3>
    </div>
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50">
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Live Reservations</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ $stats['reservations'] }}</h3>
    </div>
</section>

<section class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100">
                <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">User Details</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Role</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Activity</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse ($users as $user)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <img alt="User" class="w-10 h-10 rounded-full" src="{{ $user['avatar'] }}"/>
                            <div>
                                <p class="text-sm font-bold text-slate-900">{{ $user['name'] }}</p>
                                <p class="text-[11px] text-slate-500">{{ $user['email'] }}</p>
                                <p class="text-[11px] text-slate-400">{{ $user['joined_at'] }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $user['role'] }}</td>
                    <td class="px-6 py-4 text-sm text-slate-600">{{ $user['rides_count'] }} rides · {{ $user['bookings_count'] }} bookings · {{ $user['vehicles_count'] }} vehicles</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight {{ $user['status']['class'] }}">{{ $user['status']['label'] }}</span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a class="text-slate-400 hover:text-rose-600 transition-colors" href="{{ $user['search_url'] }}">
                            <span class="material-symbols-outlined text-xl">more_vert</span>
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-10 text-center text-slate-500" colspan="5">No users matched the current filters.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</section>
@endsection
