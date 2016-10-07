<?php

require 'PHPMailer/PHPMailerAutoload.php';

class email {

    public $mailer;

    public function __construct()
    {
        $this->mailer = New PHPMailer();
        $this->mailer->IsSMTP(); // enable SMTP
        $this->mailer->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $this->mailer->SMTPAuth = true; // authentication enabled
        $this->mailer->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
        $this->mailer->Host = "smtp.gmail.com";
        $this->mailer->Port = 465; // or 587
        $this->mailer->IsHTML(true);
        $this->mailer->Username = "maca1342book@gmail.com";
        $this->mailer->Password = "mac a1342 book";
    }

}