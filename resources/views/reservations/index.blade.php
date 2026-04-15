@extends('layouts.app')

@section('title', 'My Reservations')

@section('content')
<div class="site-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-10">
        <div class="bg-white p-4 mb-4">
          <h2 class="mb-3">My Reservations</h2>
          <p>Review your booked trips and reservation details.</p>

          @if($reservations->isEmpty())
            <div class="alert alert-info">You have no reservations yet. <a href="{{ route('cars') }}">Browse trips</a> to reserve one.</div>
          @else
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Trip</th>
                    <th>Date reserved</th>
                    <th>Reservation date</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                    <tr>
                      <td>
                        @if($reservation->trajet)
                          <a href="{{ route('trajets.show', $reservation->trajet) }}">
                            {{ $reservation->trajet->depart }} → {{ $reservation->trajet->destination }}
                          </a>
                        @else
                          Trip deleted
                        @endif
                      </td>
                      <td>{{ $reservation->created_at->format('M d, Y') }}</td>
                      <td>{{ \Carbon\Carbon::parse($reservation->date_reservation)->format('M d, Y') }}</td>
                      <td>{{ $reservation->nb_places }}</td>
                      <td>{{ ucfirst($reservation->statut) }}</td>
                      <td>
                        @if($reservation->trajet && $reservation->statut !== 'annulée' && $reservation->date_reservation->isFuture())
                          <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" onsubmit="return confirm('Confirmez-vous l\'annulation de cette réservation ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Annuler</button>
                          </form>
                        @else
                          <span class="text-muted">—</span>
                        @endif
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
