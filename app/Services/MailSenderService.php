<?php

namespace App\Services;

use App\Mail\DefaultMail;
use Illuminate\Support\Facades\Mail;

class MailSenderService
{
  public static function sendMail(
    string $receiverName,
    string $receiverMail,
    string $mailSubject,
    string $mailContent
  ) {
    Mail::send(new DefaultMail(
      receiverName: $receiverName,
      receiverMail: $receiverMail,
      mailSubject: $mailSubject,
      mailContent: $mailContent
    ));
  }
}
