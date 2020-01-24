<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompraAssistidaChangeStatus extends Mailable
{
    use Queueable, SerializesModels;

    public $id, $status, $email, $suite;

    /**
     * Create a new message instance.
     *
     * @param $id
     * @param $status
     * @param $email
     * @param $suite
     */
    public function __construct($id, $status, $email, $suite)
    {
        //
        $this->id = $id;
        $this->status = $status;
        $this->email = $email;
        $this->suite = $suite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('COMPRA ASSISTIDA - STATUS ATUALIZADO')
                    ->from('atendimento@box4buy.com')
                    ->to($this->email)
                    ->bcc('info@box4buy.com')
                    ->markdown('emails.assistida-notification');
    }
}
