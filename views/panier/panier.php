<?php
require 'models/Produits.php';

$produits = new Produits();
$panier = $produits->getPanier($_SESSION['user_id']);
var_dump($_SESSION['user_id']);



var_dump($panier);
?>

<h2>Votre panier</h2>





<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold text-gray-900 mb-6">Votre Panier</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Utilisateur ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantité</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($panier as $item): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['produit_id']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['utilisateur_id']) ?></td>
                        <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['quantite']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>