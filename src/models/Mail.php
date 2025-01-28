<?php

namespace Models;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public static function sendMail($to, $subject, $body, $attachmentPath = null)
    {
        try {
            // Instanciez PHPMailer
            $mail = new PHPMailer(true);

            // Configurations SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
            $mail->SMTPAuth   = true;
            $mail->Username   = 'votre_email@gmail.com'; // Votre email SMTP
            $mail->Password   = 'your_password';         // Votre mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configurations d'envoi
            $mail->setFrom('your_email@example.com', 'Nom de l\'expéditeur');
            $mail->addAddress($to); // Destinataire

            // Ajout d'une pièce jointe (optionnel)
            if ($attachmentPath) {
                $mail->addAttachment($attachmentPath);
            }

            // Contenu de l'email
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            // Envoi de l'email
            return $mail->send();
        } catch (Exception $e) {
            // Gérer l'erreur
            return "L'email n'a pas pu être envoyé. Erreur: {$mail->ErrorInfo}";
        }
    }
}
