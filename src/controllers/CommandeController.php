<?php 
namespace Controllers;

use Models\Commandes;
use Models\FacturePDF;
use Models\Mail;

class CommandeController {
    public function passerCommande($panier, $adresse, $email) {
        $total = array_reduce($panier, function($acc, $produit) {
            return $acc + ($produit['prix'] * $produit['quantite']);
        }, 0);

        $commandeModel = new Commandes();
        $commande_id = $commandeModel->createCommande($email, $total, $adresse);

        foreach ($panier as $produit) {
            $commandeModel->ajouterProduitCommande($commande_id, $produit['id'], $produit['quantite'], $produit['prix']);
        }

        $facture = new FacturePDF($commande_id, $email, $adresse);
        $facture->generate();

        $this->envoyerFactureParEmail($email, $commande_id);

        header("Location: facture?id=" . $commande_id);
        exit;
    }

    private function envoyerFactureParEmail($email, $commande_id) {
        $facturePath = 'src/assets/factures/facture_' . $commande_id . '.pdf';
        $subject = "Votre facture pour la commande #$commande_id";
        $message = "Merci pour votre commande. Vous trouverez ci-joint votre facture.";

        $mail = new Mail();
        $result = $mail->sendMail($email, $subject, $message, $facturePath);

        if ($result !== true) {
            error_log($result);
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $panier = $_POST['panier'] ?? [];
    $adresse = $_POST['adresse'] ?? '';
    $email = $_POST['email'] ?? '';
    $controller = new CommandeController();
    $controller->passerCommande($panier, $adresse, $email);
}