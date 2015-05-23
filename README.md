## SunMailer  

[![Build Status](https://travis-ci.org/IftekherSunny/SunMailer.svg?branch=master)](https://travis-ci.org/IftekherSunny/SunMailer)
[![Latest Stable Version](https://poser.pugx.org/sun/sunmailer/v/stable)](https://packagist.org/packages/sun/sunmailer) [![Total Downloads](https://poser.pugx.org/sun/sunmailer/downloads)](https://packagist.org/packages/sun/sunmailer) [![Latest Unstable Version](https://poser.pugx.org/sun/sunmailer/v/unstable)](https://packagist.org/packages/sun/sunmailer) [![License](https://poser.pugx.org/sun/sunmailer/license)](https://packagist.org/packages/sun/sunmailer)
  
SunMailer helps you to send email easily.

## Installation Process
 
Just copy SunMailer folder somewhere into your project directory. Then include SunMailer autoloader.        
 
```php
require_once('/path/to/SunMailer/autoload.php');
```

## Configuration

Open config.php file located at SunMailer/config.php then,

Setup your SMTP Server ( Default set to Gmail SMTP )
 
```
'host'           => 'smtp.gmail.com',
'port'           =>  465,
'encryption'     => 'ssl',
```
 
Setup your username and password:
 
```
'username'      => 'example@gmail.com',
'password'      => 'secret',
```
 
You can also add your “from” and “reply” which will include email & name.
 
```
'from'  => [ 'email' => 'admin@example.com', 'name' => 'Administrator' ],
'reply' => [ 'email' => 'contact@example.com', 'name' => 'Information' ],
```
 
Setup your email view directory. If you do not add any path of the view directory then it's pointing your root directory.
 
```
'view-directory'  => 'app/view'
```
 
If you want to test your email locally just set log  to true. ( Default set to false )
 
```
'log'   => false
```
   
   
## Send basic email
 
```php
// namespace
use SunMailer\Mailer;
use SunMailer\View;
use SunMailer\MailerException;


$email      =   'example@gmail.com';
$name       =   'Test mail name';
$subject    =   'Test mail subject';
$body       =   'Test mail body';
  
  
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
```

## Email with attached file
 
```php
$attached   =   'images/sunmailer.jpg';
 
if(Mailer::send($email, $name, $subject, $body, $attached))
{
    echo 'Email has been sent successfully.';
}
 
```
 
## Send email using view render
 
render() method of the View class helps you to render HTML outlook.
 
```php
View::render('to.path.test');
```
For pointing your file path use ( . ) or ( / ) , and add your file name without (.php) extension.
 
```php
$body = View::render('email.test');
 
if(Mailer::send($email, $name, $subject, $body))
{
    echo 'Email has been sent successfully.';
}
```
 
You can also pass any value to the view template by the second parameter of the render() method (Default set to null).
 
```php
$data  = [ 'name'  =>  'Test Name' ];
View::render('email.test', $data);
```
 
You need to add a placeholder ( added @ at the begining of your variable name ) for getting this data into view template. For the above an example is given below.
 
```php
@name
```
 
## To clean log directory
 
```php
Mailer::logClean();
```

## Some of helper functions
 
```php
// to get configuration file
Helper::config();

// to get root directory path
Helper::root_path();

// to get log directory path
Helper::log_path();

// to get temp directory path
Helper::temp_path();
```
 
## License
This package is licensed under the [MIT License](https://github.com/iftekhersunny/SunMailer/blob/master/LICENSE)
