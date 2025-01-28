<?php

namespace Controllers;

use Models\Mail;

class MailController
{
    public function sendPdfEmail()
    {
        // Variables nécessaires
        $to = 'recipient@example.com';
        $subject = 'Voici votre fichier PDF';
        $body = '<p>Veuillez trouver ci-joint le document demandé.</p>';
        $attachmentPath = __DIR__ . '/../../documents/mon-fichier.pdf'; // Remplacez par le chemin réel du fichier PDF

        // Appeler la méthode de Mail
        $result = Mail::sendMail($to, $subject, $body, $attachmentPath);

        // Afficher le résultat (dans une vue ou directement pour les tests)
        echo $result ? 'Email envoyé avec succès.' : 'Échec de l\'envoi de l\'email.';
    }
}