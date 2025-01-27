<?php
namespace Controllers;

use Models\Commandes;
use Models\FacturePDF;

class CommandeController {
    public function passerCommande($panier) {
        

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Vous devez être connecté pour passer une commande.";
            header("Location: panier"); // Rediriger vers la page du panier
            exit;
        }

        // Calculer le total de la commande
        $total = array_reduce($panier, function($acc, $produit) {
            return $acc + ($produit['prix'] * $produit['quantite']);
        }, 0);

        // Créer la commande
        $commandeModel = new Commandes();
        $commande_id = $commandeModel->createCommande($_SESSION['user_id'], $total);

        // Ajouter les produits à la commande
        foreach ($panier as $produit) {
            $commandeModel->ajouterProduitCommande($commande_id, $produit['id'], $produit['quantite'], $produit['prix']);
        }
        // Générer la facture
        $facture = new FacturePDF($commande_id);
        $facture->generate();

        // Rediriger vers la page de facture
        header("Location: facture?id=" . $commande_id);
        exit;
    }
}

// Traitement de la requête
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $panier = $_POST['panier'] ?? [];
    $controller = new CommandeController();
    $controller->passerCommande($panier);
}