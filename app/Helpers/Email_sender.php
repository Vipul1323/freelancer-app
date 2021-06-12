<?php

namespace App\Helpers;

use Config;
use Mail;
use Log;

class Email_sender
{

    public static function sendEmail($view = null, $settings = null)
    {
        if (!empty($settings) && $view != null) {
            $sent = Mail::send($view, $settings, function ($message) use ($settings) {
                $message->from($settings['from'], $settings['sender']);
                $message->to($settings['to'], $settings['receiver'])
                ->subject($settings['subject']);
            });
            //Log::info($settings);
        }
    }

    public static function newUserEmail($data = null)
    {
        if ($data != null)
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings["subject"]      = "Welcome to ".env('APP_NAME', 'Freelance Test');
            $settings['from']         = "noreply@freelancetest.com";
            $settings['to']           = $data['receiver_email'];
            $settings['sender']       = env('APP_NAME', 'Freelance Test');
            $settings['receiver']     = $data['user_name'];
            Self::sendEmail('emails.new_user', $settings);
        }
    }

    public static function newProjectEmail($data = null)
    {
        if ($data != null)
        {
            $settings                 = [];
            $settings['data']         = $data;
            $settings["subject"]      = "You have new project - ".$data['projectObj']->title;
            $settings['from']         = "noreply@freelancetest.com";
            $settings['to']           = $data['receiver_email'];
            $settings['sender']       = env('APP_NAME', 'Freelance Test');
            $settings['receiver']     = $data['user_name'];
            Self::sendEmail('emails.new_project', $settings);
        }
    }

}