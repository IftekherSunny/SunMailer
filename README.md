#SunMailer
  
SunMailer helps you to send email easily.

#Installation Process
 
Just copy SunMailer folder somewhere into your project directory. Then include SunMailer autoloader.        
 
```
require_once('/path/to/SunMailer/autoload.php');
```

#Configuration

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
   
   
#Send basic email
 
```
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

#Email with attached file
 
```
$attached   =   'images/sunmailer.jpg';
 
if(Mailer::send($email, $name, $subject, $body, $attached))
{
    echo 'Email has been sent successfully.';
}
 
```
 
#Send email using view render
 
render() method of the View class helps you to render HTML outlook.
 
```
View::render('to.path.test');
```
For pointing your file path use ( . ) or ( / ) , and add your file name without (.php) extension.
 
```
$body = View::render('email.test');
 
if(Mailer::send($email, $name, $subject, $body))
{
    echo 'Email has been sent successfully.';
}
```
 
You can also pass any value to the view template by the second parameter of the render() method (Default set to null).
 
```
$data  = [ 'name'  =>  'Test Name' ];
View::render('email.test', $data);
```
 
You need to add a placeholder ( added @ at the begining of your variable name ) for getting this data into view template. For the above an example is given below.
 
```
@name
```
 
#To clean log directory
 
```
Mailer::logClean();
```

#Some of helper functions
 
```
// to get configuration file
Helper::config();

// to get root directory path
Helper::root_path();

// to get log directory path
Helper::log_path();

// to get temp directory path
Helper::temp_path();
```
 
#License
This package is licensed under the [MIT License](https://github.com/iftekhersunny/SunMailer/blob/master/LICENSE)
