<?php
namespace Alaji\ECommerceBack\Controller;

use Models\Commandes;
use Alaji\ECommerceBack\Utils\FacturePDF;

class CommandeController {
    public function passerCommande($panier) {
        session_start();

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['user_id'])) {
            return json_encode(['success' => false, 'message' => 'Vous devez être connecté pour passer une commande.']);
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

        return json_encode(['success' => true, 'commande_id' => $commande_id]);
    }
}