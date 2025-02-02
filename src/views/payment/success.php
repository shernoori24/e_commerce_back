<?php


\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
use Controllers\CommandeController;

$sessionId = $_GET['session_id'] ?? '';

if ($sessionId) {
    $session = \Stripe\Checkout\Session::retrieve($sessionId);
    echo "<h1>Paiement réussi ! Montant payé : " . ($session->amount_total / 100) . " €</h1>";
} else {
    echo "<h1>Erreur lors du paiement.</h1>";
}





require 'vendor/autoload.php';

$email = $_GET['email'] ?? '';
$adresse = $_GET['adresse'] ?? '';
$sessionId = $_GET['session_id'] ?? '';

if ($sessionId) {
    $controller = new CommandeController();
    $controller->confirmerCommande($email, $adresse, $sessionId);
} else {
    echo "Erreur : Session ID manquant.";
}
