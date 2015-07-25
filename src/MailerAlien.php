<?php

namespace SunMailer;

class MailerAlien extends \Sun\Alien
{
    /**
     * To register Alien
     *
     * @return object
     */
    public static function registerAlien()
    {
        return 'SunMailer\Mailer';
    }
}
