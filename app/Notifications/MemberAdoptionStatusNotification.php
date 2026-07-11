<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MemberAdoptionStatusNotification extends Notification
{
    use Queueable;

    public $message;
    public $url;
    public $statusType;

    /**
     * Create a new notification instance.
     */
    public function __construct($message, $url = null, $statusType = 'info')
    {
        $this->message = $message;
        $this->url = $url;
        $this->statusType = $statusType; // success, warning, error, info
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'url' => $this->url,
            'type' => $this->statusType,
        ];
    }
}
