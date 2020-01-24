<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $ticket_support;
    public $usermail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket_id, $usermail)
    {
        $this->ticket_support = $ticket_id;
        $this->usermail = $usermail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy - RESPOSTA AO CHAMADO BXB_$this->ticket_support")
                    ->from('atendimento@box4buy.com')
                    ->to([$this->usermail])
                    ->markdown('emails.suporteresponse');
    }
}
