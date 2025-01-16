<?php

require_once 'Database.php';

function getByEmail($email) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM utilisateurs u
        JOIN roles r ON u.role_id = r.id_role
        WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

function create($nom, $email, $mot_de_passe) {
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO utilisateurs ( nom, photo, role_id, mot_de_passe, email) 
        VALUES ( ?, NULL, '3', ?, ?)");
    return $stmt->execute([$nom, password_hash($mot_de_passe, PASSWORD_DEFAULT), $email]);
}

function validateLogin($email, $mot_de_passe) {
    $user = getByEmail($email);
    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        return $user;
    }
    return false;
}