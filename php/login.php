<?php
session_start();
require_once '../models/Utilisateur.php';

$email = $_POST['email'] ?? '';
$mot_de_passe = $_POST['mot_de_passe'] ?? '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = validateLogin($email, $mot_de_passe);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_role'] = $user['role'];
        $_SESSION['user_nom'] = $user['nom'];
        $_SESSION['user_photo_profil'] = $user['photo_profil'];
        

        header("Location: ../");
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
        $_SESSION['error_connexion'] = $error;
        header("Location: ../connexion/login?form=login&error=" . urlencode($error));
    }
}