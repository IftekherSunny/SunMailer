<?php
// SunMailer autoload file
require_once('../../autoload.php');

// namespace
use SunMailer\Mailer;

$email      =   'iftekhersunny@gmail.com';
$name       =   'Iftekher Sunny';
$subject    =   'Test Mail';
$body       =   'Test mail body';
$attached   =   'images/sunmailer.jpg';

if(Mailer::send($email, $name, $subject, $body, $attached))
{
    echo 'Send email successfully';
}
else
{
    echo  'Oops!!! Something goes to wrong';
}

