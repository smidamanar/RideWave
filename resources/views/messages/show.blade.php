@extends('layouts.app')

@section('title', 'Message')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="section-title mb-5">
                    <h2>Message</h2>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">{{ $message->subject ?? 'Sujet du message' }}</h5>
                        <small class="text-muted">De: {{ $message->sender->name ?? 'Expéditeur' }} - {{ $message->created_at->diffForHumans() ?? 'Date' }}</small>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $message->content ?? 'Contenu du message...' }}</p>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('messages.index') }}" class="btn btn-secondary">Retour aux messages</a>
                    <a href="{{ route('messages.create') }}" class="btn btn-primary">Répondre</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection