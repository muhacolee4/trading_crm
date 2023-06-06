<?php

namespace App\Notifications;

use App\Models\SettingsCont;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramMessage;

class UpdateForexSignalResult extends Notification
{
    use Queueable;

    public $signal, $screenshot;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($signal, $screenshot = null)
    {
        $this->signal = $signal;
        $this->screenshot = $screenshot;
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