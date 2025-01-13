<?php

require 'models/Produits.php'; 
$results = getProduits();

?>

<h2 class="text-3xl text-gray-900 capitalize">All <span class="text-red-600">Products</span></h2>
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php foreach ($results as $product): ?>
                <div class="border p-4 rounded-lg flex flex-col items-center">
                    <img src="path/to/<?= $product['photo'] ?>" alt="<?= $product['nom'] ?>" class="mb-4">
                    <h2 class="text-xl font-bold mb-2"><?= $product['nom'] ?></h2>
                    <p class="mb-2"><?= $product['description'] ?></p>
                    <p class="mb-4 font-semibold"><?= $product['prix'] ?>€</p>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter au panier</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>