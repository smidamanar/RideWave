@php
    $notifications = auth()->user()->notifications()->latest()->take(6)->get();
    $unreadCount = auth()->user()->unreadNotifications()->count();
@endphp

<div class="relative group/notifications">
    <button class="relative flex h-11 w-11 items-center justify-center rounded-2xl border border-slate-200 bg-white text-slate-600 transition hover:border-rose-200 hover:text-rose-600" type="button">
        <span class="material-symbols-outlined text-[20px]">notifications</span>
        @if ($unreadCount > 0)
            <span class="absolute -right-1 -top-1 inline-flex min-h-5 min-w-5 items-center justify-center rounded-full bg-rose-500 px-1.5 text-[10px] font-bold text-white">{{ min($unreadCount, 9) }}</span>
        @endif
    </button>

    <div class="absolute right-0 top-full z-50 hidden pt-3 group-hover/notifications:block group-focus-within/notifications:block">
        <div class="w-[340px] overflow-hidden rounded-[28px] border border-slate-100 bg-white shadow-[0_24px_70px_rgba(15,23,42,0.16)]">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                <div>
                    <p class="text-sm font-black text-slate-900">Notifications</p>
                    <p class="text-xs font-semibold text-slate-400">{{ $unreadCount }} unread</p>
                </div>
                @if ($notifications->isNotEmpty())
                    <form action="{{ route('notifications.read-all') }}" method="POST">
                        @csrf
                        <input name="redirect_to" type="hidden" value="{{ request()->fullUrl() }}">
                        <button class="text-xs font-bold text-rose-500 transition hover:text-rose-600" type="submit">Mark all read</button>
                    </form>
                @endif
            </div>

            <div class="max-h-[360px] overflow-y-auto">
                @forelse ($notifications as $notification)
                    @php
                        $data = $notification->data;
                        $icon = match ($data['kind'] ?? null) {
                            'booking_request' => 'group_add',
                            'booking_status' => ($data['status'] ?? null) === 'confirmee' ? 'verified' : 'cancel',
                            'ride_comment' => 'chat',
                            'ride_review' => 'star',
                            default => 'notifications',
                        };
                    @endphp
                    <form action="{{ route('notifications.read', $notification->id) }}" method="POST">
                        @csrf
                        <input name="redirect_to" type="hidden" value="{{ $data['url'] ?? request()->fullUrl() }}">
                        <button class="flex w-full items-start gap-3 border-b border-slate-100 px-5 py-4 text-left transition hover:bg-slate-50 {{ $notification->read_at ? '' : 'bg-rose-50/40' }}" type="submit">
                            <span class="mt-0.5 flex h-10 w-10 items-center justify-center rounded-2xl bg-slate-100 text-slate-600">
                                <span class="material-symbols-outlined text-[18px]">{{ $icon }}</span>
                            </span>
                            <span class="block flex-1">
                                <span class="block text-sm font-bold text-slate-900">{{ $data['title'] ?? 'Notification' }}</span>
                                <span class="mt-1 block text-xs leading-5 text-slate-500">{{ $data['message'] ?? '' }}</span>
                            </span>
                        </button>
                    </form>
                @empty
                    <div class="px-5 py-10 text-center">
                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                            <span class="material-symbols-outlined">notifications_off</span>
                        </div>
                        <p class="mt-4 text-sm font-bold text-slate-900">No notifications yet</p>
                        <p class="mt-1 text-xs text-slate-500">Booking requests, replies, reviews, and decisions will appear here.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
