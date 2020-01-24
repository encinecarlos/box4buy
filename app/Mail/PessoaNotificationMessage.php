<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PessoaNotificationMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $pessoaData;
    public $suite;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $pessoaData, $suite)
    {
        $this->pessoaData = $pessoaData;
        $this->suite = $suite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Box4Buy - Bem Vindo')
                    ->from('atendimento@box4buy.com')
                    ->to([$this->pessoaData['email']])
                    ->cc(['info@box4buy.com'])
                    ->markdown('emails.pessoaNotification');
    }
}
