<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class GeneralNotification extends Notification
{
    use Queueable;

    public $type;
    public $message;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'alertType' => "alert-".$this->type,
            'message' => $this->message,
            'datetime' => date('Y-m-d H:i:s'),
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'alertType' => "alert-".$this->type,
            'message' => $this->message,
        ]);
    }
}
