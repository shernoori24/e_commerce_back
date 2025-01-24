<?php

namespace Models;

class Utilisateurs extends Bdd {

    // Récupérer un utilisateur par son email
    public function getByEmail($email) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT 

                u.id AS id,
                u.nom AS nom,
                u.email AS email,
                u.mot_de_passe AS mot_de_passe,
                u.photo AS photo,
                r.nom AS role        
                
                FROM utilisateurs u
                JOIN roles r ON u.role_id = r.id_role
                WHERE email = ?
            ");
            $stmt->execute([$email]);
            return $stmt->fetch();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
            return null;
        }
    }

    // Créer un nouvel utilisateur
    public function create($nom, $email, $mot_de_passe) {
        try {
            $stmt = $this->pdo->prepare("
                INSERT INTO utilisateurs (nom, photo, role_id, mot_de_passe, email) 
                VALUES (?, NULL, '3', ?, ?)
            ");
            $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            return $stmt->execute([$nom, $hashedPassword, $email]);
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de l'utilisateur : " . $e->getMessage());
            return false;
        }
    }

    // Valider la connexion d'un utilisateur
    public function validateLogin($email, $mot_de_passe) {
        try {
            $user = $this->getByEmail($email);
            if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
                return $user;
            }
            return false;
        } catch (\PDOException $e) {
            error_log("Erreur lors de la validation de la connexion : " . $e->getMessage());
            return false;
        }
    }
}