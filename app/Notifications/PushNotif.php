<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushNotif extends Notification implements ShouldQueue
{
    use Queueable;

    public $title, $body;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title =  NULL, $body = NULL)
    {
        $this->title = $title;
        $this->body = $body;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title($this->title)
            ->icon("/favicon.png")
            ->body($this->body)
            ->action('Voir', 'https://app.africa-africred.com');
    }
}
