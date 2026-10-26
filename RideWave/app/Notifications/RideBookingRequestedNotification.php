<?php

namespace App\Notifications;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class RideBookingRequestedNotification extends Notification
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
        return [
            'title' => 'New ride request',
            'message' => "{$this->reservation->user->name} requested {$this->reservation->nb_places} seat(s) on {$this->reservation->trajet->depart} to {$this->reservation->trajet->destination}.",
            'url' => route('driver.history'),
            'kind' => 'booking_request',
            'reservation_id' => $this->reservation->id,
            'trajet_id' => $this->reservation->trajet_id,
        ];
    }
}
