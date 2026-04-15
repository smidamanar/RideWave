@extends('layouts.app')

@section('title', 'Détails du trajet - Covoiturage')

@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-md-10">
        <div class="bg-white p-4">
          <h2 class="mb-3">{{ $trajet->depart }} → {{ $trajet->destination }}</h2>
          <p><strong>Conducteur :</strong> {{ $trajet->conducteur->name ?? 'Inconnu' }}</p>
          <p><strong>Date :</strong> {{ $trajet->date->format('d M Y') }}</p>
          <p><strong>Heure :</strong> {{ \Carbon\Carbon::parse($trajet->heure)->format('H:i') }}</p>
          <p><strong>Prix par place :</strong> ${{ number_format($trajet->prix, 2) }}</p>
          <p><strong>Places restantes :</strong> {{ $trajet->nb_places }}</p>
          <p><strong>Statut :</strong> {{ $trajet->valide ? 'Confirmé' : 'En attente' }}</p>
          @if($averageRating)
            <p><strong>Note moyenne :</strong> {{ $averageRating }} / 5</p>
          @endif

          <div class="mt-4">
            @if(auth()->check() && auth()->user()->role === 'passager')
              <a href="{{ route('reservations.create', $trajet) }}" class="btn btn-primary">Réserver ce trajet</a>
            @else
              <a href="{{ route('login') }}" class="btn btn-primary">Connectez-vous pour réserver</a>
            @endif
            <a href="{{ route('cars') }}" class="btn btn-secondary ml-2">Retour à la recherche</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row mb-5">
      <div class="col-md-6">
        <div class="bg-white p-4 mb-4">
          <h3>Contactez le conducteur</h3>
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif
          @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
          @endif
          <form action="{{ route('trajets.contact', $trajet) }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="message">Message</label>
              <textarea name="message" id="message" rows="5" class="form-control">{{ old('message') }}</textarea>
              @error('message')
                <span class="text-danger">{{ $message }}</span>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Envoyer au conducteur</button>
          </form>
        </div>
      </div>

      <div class="col-md-6">
        <div class="bg-white p-4 mb-4">
          <h3>Avis sur le trajet</h3>
          @if($reviews->isEmpty())
            <p>Aucun avis n'a encore été publié pour ce trajet.</p>
          @else
            @foreach($reviews as $review)
              <div class="border-bottom pb-3 mb-3">
                <p><strong>{{ $review['passager'] }}</strong> - {{ $review['date'] }}</p>
                <p>Note : {{ $review['note'] }} / 5</p>
                <p>{{ $review['commentaire'] }}</p>
              </div>
            @endforeach
          @endif
        </div>

        @if($canReview)
          <div class="bg-white p-4 mb-4">
            <h3>Laissez un avis</h3>
            <form action="{{ route('trajets.review', $trajet) }}" method="POST">
              @csrf
              <input type="hidden" name="reservation_id" value="{{ $userReservation->id }}">
              <div class="form-group">
                <label for="note">Note</label>
                <select name="note" id="note" class="form-control">
                  @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}" {{ old('note') == $i ? 'selected' : '' }}>{{ $i }}</option>
                  @endfor
                </select>
                @error('note')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="form-group">
                <label for="commentaire">Commentaire</label>
                <textarea name="commentaire" id="commentaire" rows="4" class="form-control">{{ old('commentaire') }}</textarea>
                @error('commentaire')
                  <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <button type="submit" class="btn btn-primary">Publier mon avis</button>
            </form>
          </div>
        @elseif(auth()->check() && auth()->user()->role === 'passager')
          <div class="bg-white p-4 mb-4">
            <p>Vous devez avoir une réservation valide pour laisser un avis sur ce trajet.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
