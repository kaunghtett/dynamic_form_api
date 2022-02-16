<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FormSubmitMail extends Mailable
{
    use Queueable, SerializesModels;

    public $form;
    public $user;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($form,$user)
    {
        $this->form = $form;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.mail')
        ->with(['form', $this->form, 'user' => $this->user]);
    }
}
