<?php
namespace Models;

class Commandes extends Bdd {
    // Créer une nouvelle commande
    public function createCommande($email, $total, $adresse) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO commandes (email, totale, adresse) VALUES (?, ?, ?) RETURNING id");
            $stmt->execute([$email, $total, $adresse]);
            return $stmt->fetchColumn();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la création de la commande : " . $e->getMessage());
            return false;
        }
    }

    // Ajouter un produit à la commande
    public function ajouterProduitCommande($commande_id, $produit_id, $quantite, $prix) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO produits_commandes (commande_id, produit_id, quantite, prix) VALUES (?, ?, ?, ?)");
            $stmt->execute([$commande_id, $produit_id, $quantite, $prix]);
            return true;
        } catch (\PDOException $e) {
            error_log("Erreur lors de l'ajout du produit à la commande : " . $e->getMessage());
            return false;
        }
    }

    // Récupérer les produits d'une commande
    public function getProduitsCommande($commande_id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.nom, pc.quantite, pc.prix
                FROM produits_commandes pc
                JOIN produits p ON pc.produit_id = p.id
                WHERE pc.commande_id = ?
            ");
            $stmt->execute([$commande_id]);
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des produits de la commande : " . $e->getMessage());
            return [];
        }
    }
}
