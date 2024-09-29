<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PushDemo extends Notification
{

    use Queueable;

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }

    public function toWebPush($notifiable, $notification)
    {
        $data = [
            'id' =>1,
            'type' => 'redirect',
        ];
        return (new WebPushMessage)
            ->title('I\'m Notification Title')
            ->icon(asset('assets/images/dummy.png'))
            ->body('Great, Push Notifications work 👌')
            ->data($data)
            ->action('View App', 'notification_action');
    }
}
