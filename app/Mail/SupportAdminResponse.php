<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SupportAdminResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $codigo_suite;
    public $ticket_support;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ticket_support, $suite)
    {
        $this->ticket_support = $ticket_support;
        $this->suite = $suite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy [SUITE CB#$this->suite] - RESPOSTA AO CHAMADO BXB_$this->ticket_support")
            ->from('atendimento@box4buy.com')
            ->to(['info@box4buy.com'])
            ->markdown('emails.suporteadminresponse');
    }
}
