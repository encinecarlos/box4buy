<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MultiDirectMessage extends Mailable
{
    use Queueable, SerializesModels;
    
    public $bodymessage;
    public $subject;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message, $subject)
    {
        $this->bodymessage = $message;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Box4Buy - {$this->subject}")
                    ->from('atendimento@box4buy.com')                    
                    ->markdown('emails.directmultiple');
    }
}
