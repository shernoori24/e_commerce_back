<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public static function sendMail($to, $subject, $body, $attachmentPath = null)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["MAIL_EXPEDITATEUR"];
            $mail->Password   = $_ENV["MDP_APP"];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom($_ENV["MAIL_EXPEDITATEUR"], $_ENV["NOM_EXPEDITATEUR"]);
            $mail->addAddress($to);

            if ($attachmentPath) {
                $mail->addAttachment($attachmentPath);
            }

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            return $mail->send();
        } catch (Exception $e) {
            return "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }
}
