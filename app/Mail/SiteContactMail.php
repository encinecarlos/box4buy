<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SiteContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $bodymessage;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $email, $bodymessage)
    {
        $this->name = $name;
        $this->email = $email;
        $this->bodymessage = $bodymessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Box4Buy - Contato do site')
                    ->from($this->email)
                    ->to('info@box4buy.com')
                    ->view('emails.sitemessage');
    }
}
