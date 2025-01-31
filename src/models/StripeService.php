<?php
namespace Models;

use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeService {
    private $secretKey;

    public function __construct() {
        // Définir la clé secrète Stripe
        $this->secretKey = $_ENV['STRIPE_SECRET_KEY'];
        Stripe::setApiKey($this->secretKey);
    }

    /**
     * Crée une session de paiement Stripe
     */
    public function createCheckoutSession($panier, $email, $adresse) {
        try {
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => array_map(function($produit) {
                    return [
                        'price_data' => [
                            'currency' => 'eur',
                            'product_data' => ['name' => $produit['nom']],
                            'unit_amount' => $produit['prix'] * 100, // En centimes
                        ],
                        'quantity' => $produit['quantite'],
                    ];
                }, $panier),
                'mode' => 'payment',
                'success_url' => "http://localhost/projets/e_commerce_back/payment/success?session_id={CHECKOUT_SESSION_ID}&email={$email}&adresse={$adresse}",
                'cancel_url' => "http://localhost/projets/e_commerce_back/payment/cancel",
            ]);

            return $session->url;
        } catch (\Exception $e) {
            return "Erreur Stripe : " . $e->getMessage();
        }
    }

    /**
     * Vérifie si le paiement est réussi
     */
    public function checkPaymentStatus($sessionId) {
        try {
            $session = Session::retrieve($sessionId);
            return $session->payment_status === 'paid';
        } catch (\Exception $e) {
            return false;
        }
    }
}
