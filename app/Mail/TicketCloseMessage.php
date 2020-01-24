<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketCloseMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketid;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticketid)
    {
        $this->ticketid = $ticketid;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy [BXB_$this->ticketid] - CHAMADO DE SUPORTE ENCERRADO")
                    ->from('atendimento@box4buy.com')
                    ->to(['info@box4buy.com'])
                    ->markdown('emails.closeNotification');
    }
}
