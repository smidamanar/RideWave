@extends('layouts.app')

@section('title', 'Reserve Trip')

@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h2 class="mb-4">Reserve this trip</h2>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <div class="bg-white p-4 mb-4">
          <h4>{{ $trajet->depart }} → {{ $trajet->destination }}</h4>
          <p><strong>Date:</strong> {{ $trajet->date->format('M d, Y') }}</p>
          <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($trajet->heure)->format('H:i') }}</p>
          <p><strong>Price per seat:</strong> ${{ number_format($trajet->prix, 2) }}</p>
          <p><strong>Seats remaining:</strong> {{ $trajet->nb_places }}</p>
          <p><strong>Driver:</strong> {{ $trajet->conducteur->name ?? 'Unknown' }}</p>
        </div>

        <form action="{{ route('reservations.store') }}" method="POST" class="p-4 bg-white">
          @csrf
          <input type="hidden" name="trajet_id" value="{{ $trajet->id }}">
          <div class="form-group">
            <label for="date_reservation">Reservation date</label>
            <input type="date" name="date_reservation" id="date_reservation" value="{{ old('date_reservation', now()->toDateString()) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="nb_places">Seats to reserve</label>
            <input type="number" name="nb_places" id="nb_places" min="1" max="{{ $trajet->nb_places }}" value="{{ old('nb_places', 1) }}" class="form-control" required>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Reserve now</button>
            <a href="{{ route('cars') }}" class="btn btn-link">Search other trips</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
