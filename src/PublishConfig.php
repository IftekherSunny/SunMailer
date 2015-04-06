<?php use SunMailer\Helper;

require_once('../autoload.php');

// to get config file path
$defaultConfigPath = Helper::config();

$rootPath = strstr($defaultConfigPath, 'vendor', true);
$publishDir = $rootPath . 'config';
$publishConfig = $publishDir . '/SunMailer.php';

if ( ! is_dir($publishDir)) mkdir($publishDir, 0755, true);

$defaultConfig = file_get_contents($defaultConfigPath);

file_put_contents($publishConfig, $defaultConfig);

echo 'Config file has been published successfully.';