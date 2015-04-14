<?php

namespace spec\SunMailer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use SunMailer\Helper;

class HelperSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('SunMailer\Helper');
    }

    function it_returns_config_file_path()
    {
        $this->config()->shouldEndWith('/SunMailer/config.php');
    }

    function it_generates_path()
    {
        $this->pathGenerate('path\to\file')->shouldReturn('path/to/file');
    }

    function it_returns_root_directory_path()
    {
        // when view-directory in config.php is set to empty string
        $this->root_path()->shouldReturn('');
    }

    function it_returns_view_directory_path()
    {
        // when view-directory in config.php is set to empty string
        $this->view_path()->shouldReturn('/');

        // view-directory set to app/view/
        $config = $this->viewDirectorySetToAppView();

        // when view-directory in config.php is set to app/view/
        $this->view_path()->shouldReturn('/app/view/');

        // reset view-directory app/view/ to empty string
        $this->viewDirectorySetToEmptyString($config);
    }

    function it_returns_log_directory_path()
    {
        $this->log_path()->shouldReturn('/logs/SunMailer');

        // view-directory set to app/view/
        $config = $this->viewDirectorySetToAppView();

        // when view-directory in config.php is set to app/view/
        $this->log_path()->shouldReturn('/app/view/logs/SunMailer');

        // reset view-directory app/view/ to empty string
        $this->viewDirectorySetToEmptyString($config);
    }

    function it_returns_temp_directory_path()
    {
        $this->temp_path()->shouldReturn('/logs/SunMailer/temp');

        // view-directory set to app/view/
        $config = $this->viewDirectorySetToAppView();

        // when view-directory in config.php is set to app/view/
        $this->temp_path()->shouldReturn('/app/view/logs/SunMailer/temp');

        // reset view-directory app/view/ to empty string
        $this->viewDirectorySetToEmptyString($config);
    }


    /**
     * @return mixed
     */
    private function viewDirectorySetToAppView()
    {
        // to get config file path
        $config = Helper::config();

        // if config file exists
        // then view-directory is set to app/view/
        if (file_exists($config)) {
            $file = file_get_contents($config);
            $file = str_replace("'view-directory'    => ''", "'view-directory'    => 'app/view/'", $file);
            file_put_contents($config, $file);
            return $config;
        }
        return $config;
    }

    /**
     * @param $config
     */
    private function viewDirectorySetToEmptyString($config)
    {
        $file = file_get_contents($config);
        $file = str_replace("'view-directory'    => 'app/view/'", "'view-directory'    => ''", $file);
        file_put_contents($config, $file);
    }
}
