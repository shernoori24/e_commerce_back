<?php
header('Content-Type: application/json');

$id = $_GET['id'] ?? null;

if ($id) {
    // Connexion à la base de données

    $produit = new \Models\Produits();


    $result = $produit->getNombreEnStock($id);

    if ($result) {
        echo json_encode(['stock' => $result['en_stock']]);
    } else {
        echo json_encode(['stock' => 0]);
    }
} else {
    echo json_encode(['stock' => 0]);
}
$utilisateursModel = new \Models\Utilisateurs();

    // Valider la connexion
    $user = $utilisateursModel->validateLogin($email, $mot_de_passe);
