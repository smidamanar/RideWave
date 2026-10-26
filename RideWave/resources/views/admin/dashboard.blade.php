@extends('admin.layouts.ridewave')

@section('title', 'RideWave Admin Portal')

@section('content')
<section class="flex flex-col md:flex-row md:items-end justify-between gap-4">
    <div>
        <h2 class="text-headline-md font-headline-md text-slate-900">Executive Overview</h2>
        <p class="text-slate-500 mt-1">Real-time performance metrics for <span class="font-bold text-rose-600">RideWave</span> ecosystem.</p>
    </div>
    <div class="flex gap-3">
        <a class="flex items-center gap-2 px-5 py-2.5 bg-white border border-slate-200 text-slate-700 rounded-xl font-bold text-sm hover:bg-slate-50 transition-all" href="{{ route('admin.analytics') }}">
            <span class="material-symbols-outlined text-lg">calendar_today</span>
            Last 30 Days
        </a>
        <a class="flex items-center gap-2 px-5 py-2.5 gradient-brand text-white rounded-xl font-bold text-sm shadow-lg shadow-rose-200 active:scale-95 transition-all" href="{{ route('admin.reports.export') }}">
            <span class="material-symbols-outlined text-lg">download</span>
            Export Report
        </a>
    </div>
</section>

<section class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50 group hover:border-rose-100 transition-colors">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center text-rose-600">
                <span class="material-symbols-outlined">payments</span>
            </div>
            <span class="px-2 py-1 rounded-lg text-xs font-bold {{ $stats['revenue_change']['positive'] ? 'text-emerald-500 bg-emerald-50' : 'text-rose-500 bg-rose-50' }}">{{ $stats['revenue_change']['label'] }}</span>
        </div>
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Monthly Revenue</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">${{ number_format($stats['monthly_revenue'], 2) }}</h3>
        <div class="mt-4 w-full h-1.5 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full gradient-brand" style="width: {{ max(10, min(100, $stats['validated_rate'])) }}%"></div>
        </div>
        <p class="text-[11px] text-slate-400 mt-2">{{ $stats['validated_rate'] }}% of rides validated across the network</p>
    </div>

    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50 group hover:border-rose-100 transition-colors">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                <span class="material-symbols-outlined">person_add</span>
            </div>
            <span class="px-2 py-1 rounded-lg text-xs font-bold {{ $stats['users_change']['positive'] ? 'text-emerald-500 bg-emerald-50' : 'text-rose-500 bg-rose-50' }}">{{ $stats['users_change']['label'] }}</span>
        </div>
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Active Users</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ number_format($stats['active_users']) }}</h3>
        <div class="mt-4 flex -space-x-2">
            @foreach ($recentUsers as $user)
                <img alt="User" class="w-7 h-7 rounded-full border-2 border-white" src="{{ $user['avatar'] }}"/>
            @endforeach
            <div class="w-7 h-7 rounded-full border-2 border-white bg-slate-100 flex items-center justify-center text-[10px] font-bold text-slate-500">+{{ max(0, $stats['active_users'] - $recentUsers->count()) }}</div>
        </div>
    </div>

    <div class="bg-white p-6 rounded-2xl soft-elevation border border-slate-50 group hover:border-rose-100 transition-colors">
        <div class="flex justify-between items-start mb-4">
            <div class="w-12 h-12 rounded-xl bg-orange-50 flex items-center justify-center text-orange-600">
                <span class="material-symbols-outlined">verified</span>
            </div>
            <span class="text-slate-400 px-2 py-1 rounded-lg text-xs font-bold">{{ $systemStatus }}</span>
        </div>
        <p class="text-slate-500 font-label-md uppercase tracking-widest text-[10px]">Completion Rate</p>
        <h3 class="text-headline-md font-headline-md text-slate-900 mt-1">{{ number_format($stats['completion_rate'], 1) }}%</h3>
        <div class="mt-4 flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
            <p class="text-[11px] text-slate-400">Current network health: {{ $systemStatus }}</p>
        </div>
    </div>
</section>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <section class="lg:col-span-1 space-y-6">
        <div class="flex items-center justify-between">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Pending Validations</h4>
            <span class="text-xs font-bold text-rose-600 bg-rose-50 px-2 py-1 rounded-md">{{ count($pendingValidations) }} NEW</span>
        </div>
        <div class="space-y-4">
            @foreach ($pendingValidations as $item)
                <div class="bg-white p-5 rounded-2xl border border-slate-100 soft-elevation hover:scale-[1.02] transition-transform">
                    <div class="flex items-start gap-4">
                        @if (!empty($item['image']))
                            <img alt="Validation item" class="w-12 h-12 rounded-xl object-cover" src="{{ $item['image'] }}"/>
                        @else
                            <div class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center text-slate-400">
                                <span class="material-symbols-outlined">{{ $item['icon'] }}</span>
                            </div>
                        @endif
                        <div class="flex-1">
                            <h5 class="text-sm font-bold text-slate-900">{{ $item['title'] }}</h5>
                            <p class="text-xs text-slate-500">{{ $item['subtitle'] }}</p>
                            <div class="flex gap-2 mt-3">
                                <a class="flex-1 py-2 bg-rose-50 text-rose-600 rounded-lg text-xs font-bold hover:bg-rose-100 transition-colors text-center" href="{{ $item['primary_url'] }}">{{ $item['primary_label'] }}</a>
                                @if ($item['secondary_kind'] === 'form')
                                    <form action="{{ $item['secondary_url'] }}" method="POST">
                                        @csrf
                                        <button class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" type="submit">
                                            <span class="material-symbols-outlined text-sm">{{ $item['secondary_label'] }}</span>
                                        </button>
                                    </form>
                                @else
                                    <a class="p-2 bg-emerald-50 text-emerald-600 rounded-lg hover:bg-emerald-100 transition-colors" href="{{ $item['secondary_url'] }}">
                                        <span class="material-symbols-outlined text-sm">{{ $item['secondary_label'] }}</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="lg:col-span-2 space-y-6">
        <div class="flex items-center justify-between">
            <h4 class="text-headline-sm font-headline-sm text-slate-900">Recent Registrations</h4>
            <a class="text-sm font-bold gradient-text hover:opacity-80 transition-opacity" href="{{ route('admin.users') }}">View All Users</a>
        </div>
        <div class="bg-white rounded-3xl soft-elevation border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">User Details</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Join Date</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest">Status</th>
                        <th class="px-6 py-4 text-[11px] font-bold text-slate-400 uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach ($recentUsers as $user)
                        <tr class="hover:bg-slate-50/30 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img alt="User" class="w-9 h-9 rounded-full" src="{{ $user['avatar'] }}"/>
                                    <div>
                                        <p class="text-sm font-bold text-slate-900">{{ $user['name'] }}</p>
                                        <p class="text-[11px] text-slate-500">{{ $user['email'] }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600">{{ $user['joined_at'] }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-tight {{ $user['status']['class'] }}">{{ $user['status']['label'] }}</span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a class="text-slate-400 hover:text-rose-600 transition-colors" href="{{ $user['search_url'] }}">
                                    <span class="material-symbols-outlined text-xl">more_vert</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-3xl p-8 text-white flex flex-col md:flex-row items-center gap-8">
            <div class="flex-1 space-y-4">
                <h5 class="text-headline-sm font-headline-sm">Network Growth</h5>
                <p class="text-slate-400 text-sm">RideWave keeps expanding through users, validated routes, and stronger fleet coverage. Open analytics for a deeper breakdown of usage patterns.</p>
                <a class="inline-flex px-6 py-2 bg-white/10 hover:bg-white/20 rounded-xl text-sm font-bold transition-all" href="{{ route('admin.analytics') }}">View Heatmaps</a>
            </div>
            <div class="w-full md:w-48 h-48 relative flex items-center justify-center">
                <svg class="w-full h-full rotate-[-90deg]" viewBox="0 0 36 36">
                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="3"></path>
                    <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="url(#gradient-sunset)" stroke-dasharray="{{ $stats['validated_rate'] }}, 100" stroke-width="3"></path>
                    <defs>
                        <linearGradient id="gradient-sunset" x1="0%" x2="100%" y1="0%" y2="0%">
                            <stop offset="0%" style="stop-color:#F26D5D;stop-opacity:1"></stop>
                            <stop offset="100%" style="stop-color:#F82E6E;stop-opacity:1"></stop>
                        </linearGradient>
                    </defs>
                </svg>
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <span class="text-2xl font-black">{{ $stats['validated_rate'] }}%</span>
                    <span class="text-[10px] text-slate-400 uppercase">Target</span>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('fab')
<a class="fixed bottom-8 right-8 w-14 h-14 gradient-brand text-white rounded-full shadow-2xl flex items-center justify-center active:scale-90 transition-transform z-50" href="{{ route('admin.users') }}">
    <span class="material-symbols-outlined text-3xl">person</span>
</a>
@endsection
