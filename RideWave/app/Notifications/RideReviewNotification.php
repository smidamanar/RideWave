<?php

namespace App\Notifications;

use App\Models\Avis;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class RideReviewNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly Avis $avis)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage|array
    {
        $reservation = $this->avis->reservation;
        $author = $reservation?->user?->name ?? 'A passenger';

        return [
            'title' => 'New ride review',
            'message' => "{$author} left a {$this->avis->note}/5 review on one of your rides.",
            'url' => route('driver.history'),
            'kind' => 'ride_review',
            'reservation_id' => $reservation?->id,
            'trajet_id' => $reservation?->trajet_id,
        ];
    }
}
