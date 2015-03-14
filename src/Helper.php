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
     * To get root directory path
     *
     * @return mixed
     */
    public static function root_path()
    {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    /**
     * To get view directory path
     *
     * @return string
     */
    public static function view_path()
    {
        $config =   require(self::config().'');
        $viewDir = $config['mail']['view-directory'];

        if( $viewDir === '' )
        {
            $viewDir = self::root_path(). '/';
        }
        else
        {
            $viewDir = self::root_path(). '/' . $viewDir;
        }

        return $viewDir;
    }

    /**
     * To get log directory path
     *
     * @return string
     */
    public static function log_path()
    {
        $config =   require(self::config().'');
        $viewDir = $config['mail']['view-directory'];

        if( $viewDir === '' )
        {
            $logPath = Helper::root_path(). '/SunMailer/log';
        }
        else
        {
            $logPath = dirname(Helper::view_path()). '/SunMailer/log';
        }

        return $logPath;
    }

    /**
     * To get temp directory path
     *
     * @return string
     */
    public static function temp_path()
    {
        $config =   require(self::config().'');
        $viewDir = $config['mail']['view-directory'];

        if( $viewDir === '' )
        {
            $tempPath = Helper::root_path(). '/SunMailer/temp';
        }
        else
        {
            $tempPath = dirname(Helper::view_path()). '/SunMailer/temp';
        }

        return $tempPath;
    }
}