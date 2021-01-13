<?php

require_once("vendor\autoload.php");

$subject = "Verify your account";
$token = bin2hex(random_bytes(50));

function send_verification_email($user_email, $token)
{
    $body = '<html lang=\"en\">
    <head>
      <meta charset=\"UTF-8\">
      <title>Test mail</title>
    </head>

    <body>
      <div class=\"wrapper\">
        <p>Thank you for signing up on our site. Please click on the link below to verify your account:.</p>
        <a href="http://localhost:63342/LoginMysql/verify_email.php?token=' . $token . '">Verify Email!</a>
      </div>
    </body>

    </html>';

    $transport = (new Swift_SmtpTransport('smtp.googlemail.com', 465, 'ssl'))
        ->setUsername('thedreamtransmission@gmail.com')
        ->setPassword('4206_nightshift');
    $mailer = new Swift_Mailer($transport);

    $message = (new Swift_Message('Verify your account'))
        ->setFrom(['thedreamtransmission@gmail.com' => 'The Dream Transmission'])
        ->setTo($user_email)
        ->setBody($body)
        ->setContentType('text/html');
    $result = $mailer->send($message);

    if ($result == 1) {
        return 1;
    } else return 0;
}