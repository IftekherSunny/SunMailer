<?php
// SunMailer autoload file
require_once('../../autoload.php');

// namespace
use SunMailer\Mailer;
use SunMailer\View;
use SunMailer\MailerException;

$email      =   'iftekhersunny@gmail.com';
$name       =   'Iftekher Sunny';
$subject    =   'Test Mail';

//'view-directory'    => 'SunMailer/examples/email-using-view-render/'
$body       =   View::render('email.test');

try
{
    if(Mailer::send($email, $name, $subject, $body))
    {
        echo 'Email has been sent successfully.';
    }
}
catch (MailerException $e)
{
    echo  'Oops!!! Something goes to wrong. '. $e->getMessage();
}