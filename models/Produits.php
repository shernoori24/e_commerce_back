<?php

require 'models/Database.php'; 

class Produits {
  public function getProduits() {
    $conn = getConnection();
    if ($conn === null) {
        return [];
    }
    try {
        $sql = "SELECT * FROM produits";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        return [];
    } finally {
        $conn = null;
    }
    return $produits;
}

  public function getPanier($id_utilisateur) {
    $conn = getConnection();

    $requete = $conn->prepare('SELECT * FROM panier WHERE utilisateur_id = :id_utilisateur');
    $requete->bindParam(':id_utilisateur', $id_utilisateur);
    $requete->execute();

    $panier = $requete->fetchAll(PDO::FETCH_ASSOC);
    return $panier;
  }
 public function ajouterAuPanier($id_produit, $id_utilisateur) {
    $conn = getConnection();
    $requete = $conn->prepare('SELECT * FROM panier WHERE produit_id = :id_produit AND utilisateur_id = :id_utilisateur');
    $requete->bindParam(':id_produit', $id_produit);
    $requete->bindParam(':id_utilisateur', $id_utilisateur);
    $requete->execute();
  
    if ($requete->rowCount() > 0) {
      // Le produit est déjà dans le panier, incrémenter la quantité
      $requete = $conn->prepare('UPDATE panier SET quantite = quantite + 1 WHERE produit_id = :id_produit AND utilisateur_id = :id_utilisateur');
      $requete->bindParam(':id_produit', $id_produit);
      $requete->bindParam(':id_utilisateur', $id_utilisateur);
      $requete->execute();
    } else {
      // Le produit n'est pas dans le panier, l'ajouter
      $requete = $conn->prepare('INSERT INTO panier (produit_id, utilisateur_id, quantite) VALUES (:id_produit, :id_utilisateur, 1)');
      $requete->bindParam(':id_produit', $id_produit);
      $requete->bindParam(':id_utilisateur', $id_utilisateur);
      $requete->execute();
    }
  }

 public function estDansPanier($id_produit, $id_utilisateur) {
    $conn = getConnection();
  
    $requete = $conn->prepare('SELECT * FROM panier WHERE produit_id = :id_produit AND utilisateur_id = :id_utilisateur');
    $requete->bindParam(':id_produit', $id_produit);
    $requete->bindParam(':id_utilisateur', $id_utilisateur);
    $requete->execute();
  
    return $requete->rowCount() > 0;
  }

  
  
 public function getNomProduit($id_produit) {
    $conn = getConnection();
  
    $requete = $conn->prepare('SELECT nom FROM produits WHERE id = :id_produit');
    $requete->bindParam(':id_produit', $id_produit);
    $requete->execute();
  
    return $requete->fetch()['nom'];
  }
}
