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

$data       =   [ 'user'  =>  'Iftekher Sunny' ];

//'view-directory'    => 'SunMailer/examples/email-using-view-render-with-data/'
$body       =   View::render('email.test', $data);

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
