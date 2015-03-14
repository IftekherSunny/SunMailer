<?php namespace SunMailer;

use PHPMailer;

class Mailer Implements MailerInterface{

    /**
     * @var config.php
     */
    protected  $config;

    /**
     * @var PHPMailer
     */
    protected $mailer;

    /**
     * @var $dirLogFile
     */
    protected $dirLogFile;

    /**
     * @var Log File Name
     */
    protected $logFileName;


    function __construct()
    {
        $this->config = require(Helper::config().'');

        $this->mailer = new PHPMailer;

        $this->dirLogFile = $this->getLogDirectory();

        $this->logFileName = $this->dirLogFile.'/log.html';
    }

    /**
     * To send an email
     *
     * @param      $email
     * @param null $name
     * @param      $subject
     * @param      $body
     * @param null $attachment
     * @param null $bcc
     *
     * @return mixed
     */
    public static function send($email, $name = null, $subject, $body, $attachment = null, $bcc = null)
    {
        return (new Mailer)->execute($email, $name, $subject, $body, $attachment, $bcc );
    }

    /**
     * To execute an email
     *
     * @param      $email
     * @param null $name
     * @param      $subject
     * @param      $body
     * @param null $attachment
     * @param null $bcc
     *
     * @return string
     * @throws \Exception
     * @throws \phpmailerException
     */
    protected function execute($email, $name = null, $subject, $body, $attachment = null, $bcc = null)
    {
        $this->mailer->isSMTP();
        $this->mailer->Host = $this->config['mail']['host'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $this->config['mail']['username'];
        $this->mailer->Password = $this->config['mail']['password'];
        $this->mailer->SMTPSecure = $this->config['mail']['encryption'];
        $this->mailer->Port = $this->config['mail']['port'];

        $this->mailer->From = $this->config['mail']['from']['email'];
        $this->mailer->FromName = $this->config['mail']['from']['name'];

        $this->mailer->addAddress($email, $name);

        $this->mailer->addReplyTo($this->config['mail']['reply']['email'], $this->config['mail']['reply']['name']);

        $this->mailer->addBCC($bcc);

        $this->mailer->addAttachment($attachment);

        $this->mailer->isHTML(true);

        $this->mailer->Subject = $subject;
        $this->mailer->Body    = $body;

        /**
         * If mail log set to true
         * then log email
         */
        if ($this->config['mail']['log'] == true) return $this->logEmail($body);

        /**
         * If mail log set to false
         * then send email
         */
        if ( $this->config['mail']['log'] !== true)
        {
            if(!$this->mailer->send()) {
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Generate Email Log File
     *
     * @param $body
     *
     * @return bool
     */
    protected function logEmail($body)
    {
        if ( ! is_dir($this->dirLogFile)) mkdir($this->dirLogFile, 0755, true);

        file_put_contents($this->logFileName, $body);

        return true;
    }

    /**
     * To clean SunMailer log directory
     */
    public static function logClean()
    {
        (new Mailer)->deleteLogDir();
    }

    /**
     * To execute log directory cleanup
     */
    protected function deleteLogDir()
    {
        $dirLog = Helper::log_path();

        if(scandir($dirLog))
        {
            array_map('unlink', glob($dirLog . '/*.html') );
        }
        rmdir($dirLog);
    }

    /**
     * @return string
     */
    protected function getLogDirectory()
    {
        return Helper::log_path();
    }

}