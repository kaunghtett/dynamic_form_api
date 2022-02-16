<?php

namespace App\Listeners;

use App\Events\FormSubmitEvent;
use App\Mail\FormSubmitMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class FormSubmitListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\FormSubmitEvent  $event
     * @return void
     */
    public function handle(FormSubmitEvent $event)
    {
        
        $user = $event->user;
        $form = $event->form;

        Mail::to($user->email)->send(new FormSubmitMail($form,$user));

    }
}
