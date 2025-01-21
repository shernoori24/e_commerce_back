<?php

require_once 'models/Produits.php';

// Traitement de la modification de la quantité
if (isset($_POST['produit_id']) && !empty($_POST['produit_id'])) {
    $produit_id = filter_var($_POST['produit_id'], FILTER_VALIDATE_INT);
    $utilisateur_id = $_POST['utilisateur_id'];
    $quantite = $_POST['quantite'];

    $produits = new Produits();
    $produits->modifierQuantite($produit_id, $utilisateur_id, $quantite);
    // Si la modification est réussie, on redirige vers la page de gestion des produits
    header('Location: panier');

    exit; // Arrête l'exécution du script après la modification
}

// Traitement de la suppression du produit
if (isset($_POST['supprimer']) && !empty($_POST['supprimer'])) {
    $produit_id = filter_var($_POST['supprimer'], FILTER_VALIDATE_INT);
    $utilisateur_id = $_POST['utilisateur_id'];

    $produits = new Produits();
    $produits->supprimerProduitDePanier($produit_id, $utilisateur_id);

    // Redirection après suppression
    header('Location: panier');
    exit; // Arrête l'exécution du script après la redirection
}