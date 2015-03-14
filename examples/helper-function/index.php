<?php
// SunMailer autoload file
require_once('../../autoload.php');

use SunMailer\Helper;
use SunMailer\Mailer;

// to get config file
echo 'Config File Path: ';
echo Helper::config();

echo '<br/>';

// to get root path
echo 'Root Path: ';
echo Helper::root_path();

echo '<br/>';

// to get log file path
echo 'Log Path: ';
echo Helper::log_path();

echo '<br/>';

// to get tamp folder path
echo 'Temp Path: ';
echo Helper::temp_path();


// to clean log directory
Mailer::logClean();
