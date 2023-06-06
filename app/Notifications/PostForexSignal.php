<?php

namespace App\Notifications;

use App\Models\SettingsCont;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class PostForexSignal extends Notification
{
    use Queueable;
    public $signal;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($signal)
    {
        $this->signal = $signal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["telegram"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        $settings = SettingsCont::find(1);

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to($settings->chat_id)
            // Markdown supported.
            ->content($this->signal);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}