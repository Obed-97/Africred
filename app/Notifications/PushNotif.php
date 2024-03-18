<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;

class PushNotif extends Notification
{
    use Queueable;

    public $title, $name, $nameCustomer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($title =  NULL, $name = NULL, $nameCustomer = NULL)
    {
        $this->title = $title;
        $this->name = $name;
        $this->nameCustomer = $nameCustomer;
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
            ->body('Le client '. $this->nameCustomer .' a été pris en charge par '. $this->name .'!')
            ->action('Voir', 'https://app.africa-africred.com');
    }
}
