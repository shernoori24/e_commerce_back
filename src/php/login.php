<?php

$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Valider les entrées
    if (empty($email) || empty($mot_de_passe)) {
        $error = "Veuillez remplir tous les champs.";
        header("Location: ../connexion/login?errore=Veuillez_remplir_tous_les_champs");
        exit;
    }

    // Instancier le modèle Utilisateurs
    $utilisateursModel = new \Models\Utilisateurs();

    // Valider la connexion
    $user = $utilisateursModel->validateLogin($email, $mot_de_passe);

    if ($user) {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_photo_profil'] = $user['photo'];

        // Rediriger vers la page d'accueil
        header("Location: ../");
        exit;
    } else {
        // En cas d'échec de la connexion
        $error = "Email ou mot de passe incorrect.";
        header("Location: ../connexion/login?error=Email_ou_Mot_de_Passe_incorrect");
        exit;
    }
}