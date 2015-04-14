<?php namespace SunMailer;


class View implements ViewInterface{

    /**
     * @var mixed config.php
     */
    protected $config;

    function __construct()
    {
        $this->config =   require(Helper::config().'');
    }

    /**
     * To render html view
     *
     * @param string $view
     * @param array  $data
     *
     * @return mixed
     * @throws Exception
     */
    public static function render($view, array $data = null)
    {
        return (new View)->execute($view, $data);
    }

    /**
     * @param       $view
     * @param array $data
     *
     * @return mixed|string
     * @throws MailerException
     */
    protected function execute($view, array $data = null)
    {
        $dirTemp = $this->getTempDirName();
        $tempView = $this->getTempViewName($dirTemp);

        $viewPath = $this->getViewPath($view);

        $this->findInPaths($view, $viewPath);

        $newView = $this->generateNewView($data, file_get_contents($viewPath));

        $this->putNewView($dirTemp, $tempView, $newView);

        $view = $this->getNewViewOutput($tempView);

        $this->deleteTempDir( $this->getTempDirName() );

        return $view;
    }

    /**
     * @param $view
     *
     * @return mixed
     */
    protected function getViewPath($view)
    {
        $view = $this->getViewDirectory($view);
        $view = str_replace('.', '/', $view);
        $view =  $view. '.php';
        return $view;
    }

    /**
     * @param $view
     *
     * @return string
     */
    protected function getNewViewOutput($view)
    {
        try {
            ob_start();
            include($view . '');
        }
        catch(Exception $e)
        {
            ob_get_clean();
        }

        return ob_get_clean();
    }

    /**
     * @param array $data
     * @param       $view
     *
     * @return mixed
     * @throws MailerException
     */
    protected function generateNewView(array $data = null, $view)
    {
        return TemplateCompiler::compile($view, $data);
    }

    /**
     * @param $dirTemp
     * @param $tempView
     * @param $newView
     */
    protected function putNewView($dirTemp, $tempView, $newView)
    {
        if ( ! is_dir($dirTemp)) mkdir($dirTemp, 0755, true);

        file_put_contents($tempView, $newView);
    }

    /**
     * @param $dirTemp
     *
     * @internal param $view
     */
    protected function deleteTempDir($dirTemp)
    {
        if(scandir($dirTemp))
        {
            $tempPath = Helper::pathGenerate($this->getTempDirName());
            array_map('unlink', glob($tempPath . '/*.php') );
        }
        rmdir($dirTemp);
    }

    /**
     * @return string
     */
    protected function getTempDirName()
    {
        return Helper::temp_path();
    }

    /**
     * @param $dirTemp
     *
     * @return string
     */
    protected function getTempViewName($dirTemp)
    {
        return $dirTemp . '/' . rand() . '.php';
    }

    /**
     * @param $view
     * @param $viewPath
     *
     * @throws MailerException
     */
    protected function findInPaths($view, $viewPath)
    {
        if ( ! file_exists($viewPath)) throw new MailerException("View [$view] not found.", E_USER_ERROR);
    }

    /**
     * @param $view
     *
     * @return string
     */
    protected function getViewDirectory($view)
    {
        $viewDir = Helper::view_path() . $view;
        return $viewDir;
    }

}
