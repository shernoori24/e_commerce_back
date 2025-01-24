<?php

namespace Models;

class Produits extends Bdd {

    // Récupérer tous les produits
    public function getProduits() {
        if ($this->pdo === null) {
            return [];
        }
        try {
            $sql = "SELECT * FROM produits";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des produits : " . $e->getMessage());
            return [];
        }
    }

    // Récupérer un produit par son ID
    public function getProduit($id) {
        try {
            $query = $this->pdo->prepare('SELECT * FROM produits WHERE id = :id');
            $query->bindParam(':id', $id);
            $query->execute();
            return $query->fetch();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération du produit : " . $e->getMessage());
            return null;
        }
    }



    // Récupérer le nom d'un produit
    public function getNomProduit($id_produit) {
        try {
            $requete = $this->pdo->prepare('SELECT nom FROM produits WHERE id = :id_produit');
            $requete->bindParam(':id_produit', $id_produit);
            $requete->execute();
            return $requete->fetch()['nom'];
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération du nom du produit : " . $e->getMessage());
            return null;
        }
    }

 


    // Créer une commande
    public function createCommande($utilisateur_id, $total) {
        try {
            $query = $this->pdo->prepare('INSERT INTO commandes (utilisateur_id, date, total) VALUES (:utilisateur_id, NOW(), :total)');
            $query->bindParam(':utilisateur_id', $utilisateur_id);
            $query->bindParam(':total', $total);
            $query->execute();
            return $this->pdo->lastInsertId();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de la commande : " . $e->getMessage());
            return false;
        }
    }

    // Créer une association entre une commande et un produit
    public function createCommandeProduit($commande_id, $produit_id, $quantite) {
        try {
            $query = $this->pdo->prepare('INSERT INTO commande_produits (commande_id, produit_id, quantite) VALUES (:commande_id, :produit_id, :quantite)');
            $query->bindParam(':commande_id', $commande_id);
            $query->bindParam(':produit_id', $produit_id);
            $query->bindParam(':quantite', $quantite);
            $query->execute();
        } catch (\PDOException $e) {
            error_log("Erreur lors de l'ajout du produit à la commande : " . $e->getMessage());
        }
    }

    // Mettre à jour le stock d'un produit
    public function updateStock($produit_id, $quantite) {
        try {
            $query = $this->pdo->prepare('UPDATE produits SET stock = stock - :quantite WHERE id = :produit_id');
            $query->bindParam(':quantite', $quantite);
            $query->bindParam(':produit_id', $produit_id);
            $query->execute();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la mise à jour du stock : " . $e->getMessage());
        }
    }

    // Récupérer une commande par son ID
    public function getCommande($commande_id) {
        try {
            $query = $this->pdo->prepare('SELECT * FROM commandes WHERE id = :commande_id');
            $query->bindParam(':commande_id', $commande_id);
            $query->execute();
            return $query->fetch();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération de la commande : " . $e->getMessage());
            return null;
        }
    }

    // Récupérer les produits d'une commande
    public function getProduitsCommande($commande_id) {
        try {
            $query = $this->pdo->prepare('
                SELECT p.nom, cp.quantite, p.prix
                FROM commande_produits cp
                JOIN produits p ON cp.produit_id = p.id
                WHERE cp.commande_id = :commande_id
            ');
            $query->bindParam(':commande_id', $commande_id);
            $query->execute();
            return $query->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des produits de la commande : " . $e->getMessage());
            return [];
        }
    }

    // Envoyer un email de confirmation de commande
    public function sendConfirmationEmail($utilisateur_id, $commande_id) {
        $utilisateur = $this->getUtilisateur($utilisateur_id);
        if ($utilisateur) {
            $subject = "Confirmation de votre commande #" . $commande_id;
            $message = "Merci pour votre commande !\n\n";
            $message .= "Numéro de commande : " . $commande_id . "\n";
            $message .= "Détails de la commande :\n";
            // Ajoutez ici les détails des produits commandés
            mail($utilisateur['email'], $subject, $message);
        }
    }

    // Récupérer un utilisateur par son ID
    public function getUtilisateur($utilisateur_id) {
        try {
            $query = $this->pdo->prepare('SELECT * FROM utilisateurs WHERE id = :utilisateur_id');
            $query->bindParam(':utilisateur_id', $utilisateur_id);
            $query->execute();
            return $query->fetch();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
            return null;
        }
 
 
    }




    public function getNombreEnStock($id){
        $query = $this->pdo->prepare('SELECT en_stock FROM produits WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();

    }
}