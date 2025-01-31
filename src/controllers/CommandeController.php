<?php 
namespace Controllers;

use Models\Commandes;
use Models\FacturePDF;
use Models\Mail;
use Models\StripeService;

class CommandeController {
    private $stripeService;

    public function __construct() {
        $this->stripeService = new StripeService();
    }

    public function passerCommande($panier, $adresse, $email) {
        if (empty($panier) || empty($adresse) || empty($email)) {
            echo "Erreur : Données manquantes.";
            return;
        }

        $paymentUrl = $this->stripeService->createCheckoutSession($panier, $email, $adresse);

        if (strpos($paymentUrl, "Erreur Stripe") !== false) {
            echo $paymentUrl;
        } else {
            header("Location: " . $paymentUrl);
            exit();
        }
    }

    public function confirmerCommande($email, $adresse, $sessionId) {
        if ($this->stripeService->checkPaymentStatus($sessionId)) {
            // Calcul du total
            $total = array_reduce($_SESSION['panier'] ?? [], function($acc, $produit) {
                return $acc + (intval($produit['prix']) * intval($produit['quantite']));
            }, 0);
    
            // Création de la commande
            $commandeModel = new Commandes();
            $commande_id = $commandeModel->createCommande($email, $total, $adresse);
    
            // Ajout des produits à la commande
            foreach ($_SESSION['panier'] ?? [] as $produit) {
                $commandeModel->ajouterProduitCommande($commande_id, $produit['id'], $produit['quantite'], $produit['prix']);
            }
    
            // Génération de la facture PDF
            $facture = new FacturePDF($commande_id, $email, $adresse);
            $facture->generate();
    
            // Envoi de la facture par email
            $this->envoyerFactureParEmail($email, $commande_id);
    
            // ✅ Rediriger vers la page "paiement réussi" avec la facture en paramètre
            header("Location: ../facture?id=" . $commande_id);
            exit();
        } else {
            echo "Le paiement a échoué.";
        }
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
    $_SESSION['panier'] = $panier;
    
    
    $totale = array_reduce($panier, function($acc, $produit) {
        return $acc + (intval($produit['prix']) * intval($produit['quantite']));
    }, 0);

    $controller = new CommandeController();
    $controller->passerCommande($panier, $adresse, $email);
}
