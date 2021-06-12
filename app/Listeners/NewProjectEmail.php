<?php

namespace App\Listeners;

use App\Events\NewProject;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helpers\Email_sender;
class NewProjectEmail
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
     * @param  NewProject  $event
     * @return void
     */
    public function handle(NewProject $event)
    {
        $projectObj = $event->project;
        $data = [
            'receiver_email'    => $projectObj->AssignedTo->email,
            'user_name'         => $projectObj->AssignedTo->getFullName(),
            'projectObj'        => $projectObj,
        ];
        Email_sender::newProjectEmail($data);
    }
}
