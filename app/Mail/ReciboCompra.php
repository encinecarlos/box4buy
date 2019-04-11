<?php

namespace App\Mail;

use App\CompraAssistidaInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReciboCompra extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var CompraAssistidaInfo
     */
    public $assistidaInfo;

    /**
     * Create a new message instance.
     *
     * @param CompraAssistidaInfo $assistidaInfo
     */
    public function __construct(CompraAssistidaInfo $assistidaInfo)
    {
        $this->assistidaInfo = $assistidaInfo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('COMPRA ASSISTIDA BOX4BUY - RECIBO')
            ->from('atendimento@box4buy.com', 'Equipe Box4Buy')
            ->to($this->assistidaInfo->usuario->email)
            ->markdown('emails.recibo-compra');
    }
}
