<?php namespace SunMailer;

interface ViewInterface {

    /**
     * @param string $viewPath
     * @param array  $data
     *
     * @return mixed
     */
    public static function render($viewPath, array $data);
}