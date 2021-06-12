<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Helpers\Email_sender;
use App\Events\NewUser;

class NewUserEmail
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
     * @param  NewUser  $event
     * @return void
     */
    public function handle(NewUser $event)
    {
        $userObj = $event->user;
        $data = [
            'receiver_email'    => $userObj->email,
            'user_name'         => $userObj->getFullName(),
            'userObj'           => $userObj,
        ];
        Email_sender::newUserEmail($data);
    }
}
