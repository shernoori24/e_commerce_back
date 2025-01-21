<?php
$produits = new Produits();
$produitId = $_GET['produitId'];
$utilisateurId = $_GET['utilisateurId'];
$produits->ajouterAuPanier($produitId, $utilisateurId);
