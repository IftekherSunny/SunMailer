<?php namespace SunMailer;

class MailerException extends \Exception{

    /**
     * @param string $message
     */
    function __construct($message)
    {
        parent::__construct($message);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getMessage();
    }
}