@extends('layouts.app')

@section('title', 'Messages')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-5">
                    <h2>Mes Messages</h2>
                </div>
                <div class="mb-4">
                    <a href="{{ route('messages.create') }}" class="btn btn-primary">Nouveau message</a>
                </div>
                @if($messages->count() > 0)
                    <div class="list-group">
                        @foreach($messages as $message)
                            <a href="{{ route('messages.show', $message->id) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $message->subject }}</h5>
                                    <small>{{ $message->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ Str::limit($message->content, 100) }}</p>
                                <small>De: {{ $message->sender->name }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center">
                        <p>Vous n'avez pas de messages pour le moment.</p>
                        <p class="text-muted">Les messages apparaîtront ici lorsque vous contacterez des conducteurs ou passagers.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection