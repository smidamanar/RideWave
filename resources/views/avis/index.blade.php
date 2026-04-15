@extends('layouts.app')

@section('title', 'Avis Reçus')

@section('content')
<div class="site-section bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title mb-5">
                    <h2>Avis Reçus</h2>
                </div>
                @if($avis->count() > 0)
                    <div class="row">
                        @foreach($avis as $review)
                            <div class="col-md-6 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h5 class="card-title mb-0">{{ $review->reservation->user->name }}</h5>
                                            <div class="rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="icon-star {{ $i <= $review->note ? 'text-warning' : 'text-muted' }}"></span>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="card-text">{{ $review->commentaire }}</p>
                                        <small class="text-muted">Trajet: {{ $review->reservation->trajet->pickup }} → {{ $review->reservation->trajet->dropoff }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>Vous n'avez pas encore reçu d'avis.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection