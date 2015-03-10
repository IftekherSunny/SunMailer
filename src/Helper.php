<?php namespace SunMailer;

class Helper {

    /**
     * To get config file path
     *
     * @return mixed
     */
    public static function config()
    {
        $realpath = realpath(__DIR__.'/..');
        $config = (str_replace('\\','/',$realpath)).'/config.php';

        return $config;
    }

    /**
     * To generate path
     *
     * @param $dirTemp
     *
     * @return mixed
     */
    public static function pathGenerate($dirTemp)
    {
        return (str_replace('\\','/',$dirTemp));
    }

    /**
     * To get SunMailer log directory path
     *
     * @return string
     */
    public static function logPath()
    {
        $realpath = realpath(__DIR__.'/../..');
        $logPath = (str_replace('\\','/',$realpath)).'/logs/SunMailer';

        return $logPath;
    }
}