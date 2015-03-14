<?php namespace SunMailer;

interface ViewInterface {

    /**
     * To render html view
     *
     * @param string $viewPath
     * @param array  $data
     *
     * @return mixed
     */
    public static function render($viewPath, array $data);
}