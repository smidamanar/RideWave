<?php

namespace App\Notifications;

use App\Models\RideComment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class RideCommentNotification extends Notification
{
    use Queueable;

    public function __construct(private readonly RideComment $comment)
    {
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): DatabaseMessage|array
    {
        $ride = $this->comment->trajet;

        return [
            'title' => $this->comment->parent_id ? 'New reply on a ride thread' : 'New ride comment',
            'message' => "{$this->comment->user->name} commented on {$ride->depart} to {$ride->destination}.",
            'url' => $notifiable->isDriver() ? route('driver.history') : route('passenger.history'),
            'kind' => 'ride_comment',
            'comment_id' => $this->comment->id,
            'trajet_id' => $ride->id,
        ];
    }
}
