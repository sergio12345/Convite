<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $url)
    {
        $this->url = $url;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Resetar senha - Mais Convite')
                    ->from('maisconvite@ultrahaus.com', 'Mais Convite')
                    ->greeting('Olá!')
                    ->line('Esqueceu a senha?')
                    ->action('Click para resetar', config('services.urls.APP_URL') . "/reset-password/" . $this->url)
                    ->line('Equipe Mais Convite.');
    }

    //http://localhost:8080/reset-password/8294d85d51d14e3d1af846817a1a24a028036a75e8a9dc2d6f72dcd5ced5a4e0?email=sergio%40gmail.com

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
