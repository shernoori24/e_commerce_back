<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;


function sendEmail($destinataire, $sujet, $corpsHtml, $corpsTexte, $piecesJointes = []) {
    $mail = new PHPMailer(true);

    try {
        // Configuration du serveur SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';               // Serveur SMTP de Gmail
        $mail->SMTPAuth   = true;                           // Authentification activée
        $mail->Username   = $_ENV["MAIL_EXPEDITATEUR"];     // Votre adresse Gmail
        $mail->Password   = $_ENV["MDP_APP"];               // Mot de passe d'application Gmail
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Type de cryptage
        $mail->Port       = 587;                            // Port pour STARTTLS

        // Expéditeur et destinataire
        $mail->setFrom($_ENV["MAIL_EXPEDITATEUR"], $_ENV["NOM_EXPEDITATEUR"]);
        $mail->addAddress($destinataire);                   // Adresse du destinataire

        // Pièces jointes
        foreach ($piecesJointes as $piece) {
            $mail->addAttachment($piece['tmp_name'], $piece['name']);
        }

        // Contenu de l'email
        $mail->isHTML(true);                                // Activer HTML
        $mail->Subject = $sujet;                            // Sujet de l'email
        $mail->Body    = $corpsHtml;                        // Corps en HTML
        $mail->AltBody = $corpsTexte;                       // Alternative en texte brut

        // Envoi
        $mail->send();
        return "Message envoyé avec succès.";
    } catch (Exception $e) {
        return "Erreur : " . $mail->ErrorInfo;
    }
}

$message = ''; // Message à afficher à l'utilisateur
if (isset($_POST["envoi_mail"])) {
    $destinataire = $_ENV["MAIL_DESTINATEUR"];
    $sujet = $_POST["sujet"] ?? 'Sujet par défaut';
    $corpsHtml = $_POST["corps_html"] ?? 'Corps HTML par défaut';
    $corpsTexte = $_POST["corps_texte"] ?? 'Corps texte par défaut';

    // Gestion des pièces jointes
    $piecesJointes = [];
    if (!empty($_FILES['pieces_jointes']['name'][0])) {
        foreach ($_FILES['pieces_jointes']['tmp_name'] as $key => $tmp_name) {
            $piecesJointes[] = [
                'tmp_name' => $tmp_name,
                'name'     => $_FILES['pieces_jointes']['name'][$key]
            ];
        }
    }

    $message = sendEmail($destinataire, $sujet, $corpsHtml, $corpsTexte, $piecesJointes);
}
?>

<body class="p-6 bg-gray-100">
    <div class="max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-md">
        <h1 class="mb-6 text-3xl font-bold text-center">Envoyer un e-mail</h1>

        <?php if (!empty($message)) : ?>
            <div class="mb-6 p-4 rounded <?= strpos($message, 'Erreur') === false ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form action="" method="post" enctype="multipart/form-data" class="space-y-6">
            <!-- Sujet -->
            <div>
                <label for="sujet" class="block text-sm font-medium text-gray-700">Sujet</label>
                <input type="text" name="sujet" id="sujet" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            </div>

            <!-- Corps HTML -->
            <div>
                <label for="corps_html" class="block text-sm font-medium text-gray-700">Corps HTML</label>
                <textarea name="corps_html" id="corps_html" rows="6" required
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Corps texte -->
            <div>
                <label for="corps_texte" class="block text-sm font-medium text-gray-700">Corps texte (alternative)</label>
                <textarea name="corps_texte" id="corps_texte" rows="4"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
            </div>

            <!-- Pièces jointes -->
            <div>
                <label for="pieces_jointes" class="block text-sm font-medium text-gray-700">Pièces jointes</label>
                <input type="file" name="pieces_jointes[]" id="pieces_jointes" multiple
                    class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            </div>

            <!-- Bouton d'envoi -->
            <div class="text-center">
                <button type="submit" name="envoi_mail"
                    class="px-6 py-2 font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Envoyer l'e-mail
                </button>
            </div>
        </form>
    </div>
</body>