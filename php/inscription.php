<?php
session_start();
require_once '../models/Utilisateur.php';

$nom = $_POST['nom'] ?? '';
$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données
    if (empty($nom) || empty($email) || empty($mot_de_passe)) {
        $error = "Tous les champs doivent être remplis.";
        header("Location: ../connexion/inscription?form=signup&error=" . urlencode($error));
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "L'email n'est pas valide.";
        header("Location: ../connexion/inscription?form=signup&error=" . urlencode($error));
        exit;
    }

    // Vérifier si l'utilisateur existe déjà
    if (getByEmail($email)) {
        $error = "L'email n'est pas encore valide.";
        header("Location: ../connexion/inscription?form=signup&error=" . urlencode($error));
        exit;
    }
    
    if (create($nom, $email, $mot_de_passe)) {
        
        $user = getByEmail($email);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_photo_profil'] = $user['photo'];


        header("Location: ../");
        exit;
    } else {
        $error = "Une erreur s'est produite lors de l'inscription.";
        header("Location: ../connexion/inscription?form=signup&error=" . urlencode($error));
        exit;
    }
}