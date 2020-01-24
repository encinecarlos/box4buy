<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AnnouncementNotification extends Notification
{
    use Queueable;

    private $message;
    private $icon;
    private $type;
    private $extrainfo;

    /**
     * Create a new notification instance.
     *
     * @param $message A mensagem a ser exibida na notificação
     * @param $type O modulo que esta chamando a notificação
     * @param string $icon O icone da notificação
     * @param null $extrainfo recebe um parametro extra, caso aplicavel
     */
    public function __construct($message, $type,$icon = "fa fa-check", $extrainfo = null)
    {
        $this->icon = $icon;
        $this->type = $type;
        $this->extrainfo = $extrainfo;
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
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    /*public function toArray($notifiable)
    {
        return [
            'message' => 'Teste de notificação'
        ];
    }*/

    public function toDatabase($notifiable)
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
            'icon' => $this->icon,
            'extrainfo' => $this->extrainfo
        ];
    }
}
