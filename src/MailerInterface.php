<?php namespace SunMailer;

interface MailerInterface {

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
    public static function send( $email, $name = null, $subject, $body, $attachment = null, $bcc = null);
}