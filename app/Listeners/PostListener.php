<?php

namespace App\Listeners;

use App\Events\PostEvent;
use App\Mail\PostMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PostListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param PostEvent $event
     * @return void
     */
    public function handle(PostEvent $event)
    {
        /*
         * Lorsque l'evenement PostEvent est emit par l'application,
         * mon écouteur se déclenche et met en application son rôle.
         * Ici, un simple envoi de mail ; mais nous pouvons imaginer
         * un système beaucoup plus complexe...
         */
        Mail::to('redaction@actu.news')
            ->send(new PostMail($event->post));
    }
}
