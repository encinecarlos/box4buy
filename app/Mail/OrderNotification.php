<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $suite;
    public $email;
    public $cod_orcamento;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($suite, $email, $cod_orcamento)
    {
        $this->suite = $suite;
        $this->email = $email;
        $this->cod_orcamento = $cod_orcamento;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy [SUITE CB#$this->suite] - NOVO ORÇAMENTO SOLICITADO")
            ->from('atendimento@box4buy.com')
            ->to([$this->email])
            ->bcc('info@box4buy.com')
            ->markdown('emails.ordernotification');
    }
}
