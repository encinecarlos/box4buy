<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminSupportMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $ticketdata;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket)
    {
        $this->ticketdata = $ticket;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy - Novo chamado de Suporte")
                    ->from('atendimento@box4buy.com')
                    ->to(['info@box4buy.com'])
                    ->markdown('emails.suporteadmin'); 
    }
}
