@php
    $topLevelComments = $ride->comments ?? collect();
    $isDriverOfRide = auth()->id() === $ride->conducteur_id;
    $collapsible = $collapsible ?? false;
    $openByDefault = $openByDefault ?? false;
@endphp

<div
    class="mt-4 rounded-[22px] border border-slate-100 bg-white/80 p-4 {{ $collapsible && ! $openByDefault ? 'hidden' : '' }}"
    @if($collapsible)
        data-comments-panel
    @endif
>
    <div class="mb-4 flex items-center justify-between gap-3">
        <div>
            <p class="text-[10px] font-extrabold uppercase tracking-[0.18em] text-slate-400">Ride discussion</p>
            <p class="mt-1 text-sm font-bold text-slate-900">{{ $topLevelComments->count() }} message{{ $topLevelComments->count() === 1 ? '' : 's' }}</p>
        </div>
        <span class="rounded-full bg-rose-50 px-3 py-1 text-[10px] font-bold uppercase tracking-[0.18em] text-rose-600">
            {{ $isDriverOfRide ? 'Driver replies' : 'Passenger questions' }}
        </span>
    </div>

    <div class="space-y-4">
        @forelse ($topLevelComments->take(3) as $comment)
            <div class="rounded-[20px] bg-slate-50 p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-white text-sm font-black text-slate-700">
                        {{ strtoupper(substr($comment->user->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-900">{{ $comment->user->name }}</p>
                        <p class="text-[11px] font-semibold text-slate-400">{{ $comment->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p class="mt-3 text-sm leading-6 text-slate-600">{{ $comment->body }}</p>

                @if ($comment->replies->isNotEmpty())
                    <div class="mt-4 space-y-3 border-l-2 border-rose-100 pl-4">
                        @foreach ($comment->replies->take(2) as $reply)
                            <div class="rounded-[18px] bg-white px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <p class="text-xs font-black text-slate-900">{{ $reply->user->name }}</p>
                                    <span class="text-[10px] font-semibold uppercase tracking-[0.16em] text-rose-500">{{ $reply->user_id === $ride->conducteur_id ? 'Driver' : 'Reply' }}</span>
                                </div>
                                <p class="mt-1 text-sm leading-6 text-slate-600">{{ $reply->body }}</p>
                            </div>
                        @endforeach
                    </div>
                @endif

                @if ($isDriverOfRide)
                    <form action="{{ route('rides.comments.store', $ride) }}" class="mt-4 flex flex-col gap-3 sm:flex-row" method="POST">
                        @csrf
                        <input name="parent_id" type="hidden" value="{{ $comment->id }}">
                        <input class="w-full rounded-[16px] border border-slate-200 bg-white px-4 py-3 text-sm font-semibold text-slate-900 focus:border-rose-300 focus:ring-rose-200" maxlength="1000" name="body" placeholder="Reply to this passenger..." type="text">
                        <button class="inline-flex items-center justify-center gap-2 rounded-[16px] bg-slate-900 px-4 py-3 text-sm font-bold text-white transition hover:bg-slate-800" type="submit">
                            <span class="material-symbols-outlined text-base">reply</span>
                            Reply
                        </button>
                    </form>
                @endif
            </div>
        @empty
            <div class="rounded-[20px] border border-dashed border-slate-200 bg-slate-50 px-4 py-6 text-center text-sm font-semibold text-slate-500">
                No messages yet for this ride.
            </div>
        @endforelse
    </div>

    @if (! $isDriverOfRide)
        <form action="{{ route('rides.comments.store', $ride) }}" class="mt-4 flex flex-col gap-3 sm:flex-row" method="POST">
            @csrf
            <input class="w-full rounded-[18px] border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-rose-300 focus:ring-rose-200" maxlength="1000" name="body" placeholder="Ask the driver something about this ride..." type="text">
            <button class="inline-flex items-center justify-center gap-2 rounded-[18px] bg-gradient-to-r from-[#f26d5d] to-[#f82e6e] px-5 py-3 text-sm font-bold text-white transition hover:scale-[1.01]" type="submit">
                <span class="material-symbols-outlined text-base">send</span>
                Comment
            </button>
        </form>
    @endif
</div>
