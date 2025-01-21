<?php

if (isset($_POST['commander'])) {
  // Vérification de la session utilisateur
  if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
  }

  $produits = new Produits();
  // Récupération des informations de commande
  $user_id = $_SESSION['user_id'];
  $panier = $produits->getPanier($user_id);
  $total = 0;
  foreach ($panier as $item) {
    $total += $item['prix'] * $item['quantite'];
  }

  // Enregistrement de la commande dans la base de données
  $commande_id = $produits->createCommande($user_id, $total);
  foreach ($panier as $item) {
    $produits->createCommandeProduit($commande_id, $item['produit_id'], $item['quantite']);
  }

  // Mise à jour du stock des produits
  foreach ($panier as $item) {
    $produits->updateStock($item['produit_id'], $item['quantite']);
  }

  // Envoi d'un e-mail de confirmation de commande
  $produits->sendConfirmationEmail($user_id, $commande_id);

  // Redirection vers la page de confirmation de commande
  header('Location: confirmation.php');
  exit;
}