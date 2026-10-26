<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class RideBookingStatusNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Reservation $reservation)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage|array
    {
        $accepted = $this->reservation->statut === Reservation::STATUS_CONFIRMED;

        return [
            'title' => $accepted ? 'Ride request accepted' : 'Ride request declined',
            'message' => $accepted
                ? "Your request for {$this->reservation->trajet->depart} to {$this->reservation->trajet->destination} was accepted."
                : "Your request for {$this->reservation->trajet->depart} to {$this->reservation->trajet->destination} was declined.",
            'url' => route('passenger.history'),
            'kind' => 'booking_status',
            'reservation_id' => $this->reservation->id,
            'trajet_id' => $this->reservation->trajet_id,
            'status' => $this->reservation->statut,
        ];
    }
}
