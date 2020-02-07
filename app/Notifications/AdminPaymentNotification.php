<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AdminPaymentNotification extends Notification
{
    use Queueable;

    public $orcamento;
    public $status;

    /**
     * AdminPaymentNotification constructor.
     * @param $orcamento
     * @param $status
     */
    public function __construct($orcamento, $status)
    {
        $this->orcamento = $orcamento;
        $this->status = $status;
    }

    /**
     * Create a new notification instance.
     *
     * @return void
     */


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
                    ->subject("BOX4BUY - STATUS DO ORÇAMENTO {$this->orcamento}")
                    ->greeting("Olá, {$notifiable->nome_completo}")
                    ->line("O pagamento referente ao orçamento de código {$this->orcamento} foi efetuado. Abaxio sege as informações para a continuidade do processo:")
                    ->line("Código do orçamento: {$this->orcamento}")
                    ->line("Status: PAGO")
                    ->line('Acesse o link abaixo para dar continuidade ao processo.')
                    ->action('GERENCIAR ORÇAMENTO', url()->route('orcamento-edit', $this->orcamento));
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
