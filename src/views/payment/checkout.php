<?php

\Stripe\Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']); // Ta clé secrète

$prix_total = 50 * 100; // Convertir en centimes (Stripe fonctionne en centimes)

try {
    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => 'Paiement Commande de Jonline Entreprise', // Nom affiché
                ],
                'unit_amount' => $prix_total,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://localhost/projets/e_commerce_back/payment/success?session_id={CHECKOUT_SESSION_ID}',
        'cancel_url' => 'http://localhost/projets/e_commerce_back/payment/cancel',
    ]);

    // Rediriger vers Stripe Checkout
    header("Location: " . $session->url);
    exit();

} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}