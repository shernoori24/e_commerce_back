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
    public function addProduit($data) {
        // Validation des données
        if (empty($data['nom']) || empty($data['prix']) || empty($data['en_stock']) || empty($data['categorie_id']) || empty($data['photo'])) {
            throw new \InvalidArgumentException("Tous les champs obligatoires doivent être remplis.");
        }
    
        if (!is_numeric($data['prix']) || $data['prix'] <= 0) {
            throw new \InvalidArgumentException("Le prix doit être un nombre positif.");
        }
    
        if (!is_numeric($data['en_stock']) || $data['en_stock'] < 0) {
            throw new \InvalidArgumentException("Le stock doit être un nombre positif ou zéro.");
        }
    
        try {
            // Requête SQL pour insérer un nouveau produit
            $sql = "INSERT INTO produits (nom, prix, en_stock, description, categorie_id, photo) 
                    VALUES (:nom, :prix, :en_stock, :description, :categorie_id, :photo)";
            $stmt = $this->pdo->prepare($sql);
    
            // Exécuter la requête avec les données du formulaire
            $stmt->execute([
                'nom' => $data['nom'],
                'prix' => $data['prix'],
                'en_stock' => $data['en_stock'],
                'description' => $data['description'],
                'categorie_id' => $data['categorie_id'],
                'photo' => $data['photo']
            ]);
    
            return true; // Retourne true si l'insertion réussit
        } catch (\PDOException $e) {
            // En cas d'erreur, enregistrer l'erreur dans les logs
            error_log("Erreur lors de l'ajout du produit : " . $e->getMessage());
            return false; // Retourne false en cas d'échec
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
    public function getNombreEnStock($id){
        $query = $this->pdo->prepare('SELECT en_stock FROM produits WHERE id = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();

    }
    public function getCategories() {
        try {
            $sql = "SELECT * FROM categories_produits ORDER BY nom ASC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            error_log("Erreur lors de la récupération des catégories : " . $e->getMessage());
            return [];
        }
    }

    public function addCategorie($nom) {
        try {
            $sql = "INSERT INTO categories_produits (nom) VALUES (:nom) RETURNING id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute(['nom' => $nom]);
            return $stmt->fetch()['id'];
        } catch (\PDOException $e) {
            error_log("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
            return null;
        }
    }
}