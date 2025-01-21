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
public function getProduit($id) {
  $conn = getConnection();
  $query = $this->$conn->prepare('SELECT * FROM produits WHERE id = :id');
  $query->bindParam(':id', $id);
  $query->execute();
  return $query->fetch();
}

  public function getPanier($id_utilisateur) {
    $conn = getConnection();

    $requete = $conn->prepare('SELECT * FROM panier 
  
    JOIN produits on produits.id = panier.produit_id 
    
    
    
    WHERE utilisateur_id = :id_utilisateur'
    );
  

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

  public function modifierQuantite($produitId, $utilisateurId, $quantite) {
    $conn = getConnection();
    $requete = $conn->prepare('UPDATE panier SET quantite = :quantite WHERE produit_id = :produitId AND utilisateur_id = :utilisateurId');
    $requete->bindParam(':quantite', $quantite);
    $requete->bindParam(':produitId', $produitId);
    $requete->bindParam(':utilisateurId', $utilisateurId);
    $requete->execute();
    echo 'modifié';
}
public function supprimerProduitDePanier($produitId, $utilisateurId){
  $conn = getConnection();
  $requete = $conn->prepare('DELETE FROM panier WHERE produit_id = :produitId AND utilisateur_id = :utilisateurId');
  $requete->bindParam(':produitId', $produitId);
  $requete->bindParam(':utilisateurId', $utilisateurId);
  $requete->execute();
  echo 'supprimé';
  }

  public function createCommande($utilisateur_id, $total) {
    try {
      $conn = getConnection();
        $query = $conn->prepare('INSERT INTO commandes (utilisateur_id, date, total) VALUES (:utilisateur_id, NOW(), :total)');
        $query->bindParam(':utilisateur_id', $utilisateur_id);
        $query->bindParam(':total', $total);
        $query->execute();
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        // Gérer l'erreur, par exemple en enregistrant dans un fichier log
        error_log($e->getMessage());
        return false;
    }
}
// fuat creer cette funtion
// createCommandeProduit

public function updateStock($produit_id, $quantite) { 
     $conn = getConnection();

  $query = $conn->prepare('UPDATE produits SET stock = stock - :quantite WHERE id = :produit_id');
  $query->bindParam(':quantite', $quantite);
  $query->bindParam(':produit_id', $produit_id);
  $query->execute();
}


public function getCommande($commande_id) {
  $conn = getConnection();

  $query = $conn->prepare('SELECT * FROM commandes WHERE id = :commande_id');
  $query->bindParam(':commande_id', $commande_id);
  $query->execute();
  return $query->fetch();
}

public function getProduitsCommande($commande_id) {
  $conn = getConnection();

  $query = $conn->prepare('
      SELECT p.nom, cp.quantite, p.prix
      FROM commande_produits cp
      JOIN produits p ON cp.produit_id = p.id
      WHERE cp.commande_id = :commande_id
  ');
  $query->bindParam(':commande_id', $commande_id);
  $query->execute();
  return $query->fetchAll();
}

public function sendConfirmationEmail($utilisateur_id, $commande_id) {
  $utilisateur = $this->getUtilisateur($utilisateur_id);
  $subject = "Confirmation de votre commande #" . $commande_id;
  $message = "Merci pour votre commande !\n\n";
  $message .= "Numéro de commande : " . $commande_id . "\n";
  $message .= "Détails de la commande :\n";
  // Ajoutez ici les détails des produits commandés
  mail($utilisateur['email'], $subject, $message);
}

public function getUtilisateur($utilisateur_id) {
  $conn = getConnection();

  $query = $conn->prepare('SELECT * FROM utilisateurs WHERE id = :utilisateur_id');
  $query->bindParam(':utilisateur_id', $utilisateur_id);
  $query->execute();
  return $query->fetch();
}
}