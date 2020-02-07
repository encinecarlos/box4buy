<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderStatusNotification extends Notification
{
    use Queueable;

    public $orcamentoStatus;
    public $orcamentoid;
    private $status;

    /**
     * Create a new notification instance.
     *
     * @param $orcamentoid
     * @param $orcamentoStatus
     */
    public function __construct($orcamentoid, $orcamentoStatus)
    {
        $this->orcamentoid = $orcamentoid;
        $this->orcamentoStatus = $orcamentoStatus;

        switch ($this->orcamentoStatus) {
            case 4:
                $this->status = 'Pendente';
                break;
            case 5:
                $this->status = 'Aprovado';
                break;
            case 6:
            case 7:
                $this->status = 'Preparando para Envio';
                break;
            case 8:
                $this->status = 'Enviado ao cliente';
                break;
        }
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
                    ->level('success')
                    ->from('atendimento@box4buy.com', 'Atendimento Box4Buy')
                    ->subject("Box4Buy [CB{$notifiable->codigo_suite}] - STATUS DO ORÇAMENTO {$this->orcamentoid}")
                    ->greeting('Olá, '.$notifiable->nome_completo)
                    ->line('Seu orçamento acaba de ser atualizado. Abaixo algumas informações a respeito:')
                    ->line('Código do orçamento: '. $this->orcamentoid)
                    ->line('Situação do Orçamento: '. $this->status)
                    ->line('Para maiores detalhes clique no botão abaixo')
                    ->action('Ver Orçamento', url()->route('pagamento-invoice', $this->orcamentoid));

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
