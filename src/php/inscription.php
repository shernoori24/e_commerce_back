<?php

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données
    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        $error = "Tous les champs doivent être remplis.";
        $_SESSION['error_inscription'] = $error;
        header("Location: ../connexion/inscription?form=signup");
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'email n'est pas valide.";
        $_SESSION['error_inscription'] = $error;
        header("Location: ../connexion/inscription?form=signup");
        exit;
    }

    // Instancier le modèle Utilisateurs
    $utilisateursModel = new \Models\Utilisateurs();

    // Vérifier si l'utilisateur existe déjà
    if ($utilisateursModel->getByEmail($email)) {
        $error = "Un utilisateur avec cet email existe déjà.";
        $_SESSION['error_inscription'] = $error;
        header("Location: ../connexion/inscription?form=signup");
        exit;
    }

    // Créer un nouvel utilisateur
    if ($utilisateursModel->create($nom, $email, $mot_de_passe)) {
        // Récupérer l'utilisateur nouvellement créé
        $user = $utilisateursModel->getByEmail($email);

        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_photo_profil'] = $user['photo'];

        // Rediriger vers la page d'accueil
        header("Location: ../");
        exit;
    } else {
        $error = "Une erreur s'est produite lors de l'inscription.";
        $_SESSION['error_inscription'] = $error;
        header("Location: ../connexion/inscription?form=signup");
        exit;
    }
}