<?php
// Récupérer les détails du produit depuis le contrôleur
$produit = $produit_trouve;
?>

<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <div class="overflow-hidden bg-white rounded-lg shadow-md">
            <img src="<?= htmlspecialchars($produit['photo']) ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="object-cover w-full h-64">
            <div class="p-6">
                <h1 class="mb-4 text-3xl font-bold"><?= htmlspecialchars($produit['nom']) ?></h1>
                <p class="mb-4 text-gray-700"><?= htmlspecialchars($produit['description']) ?></p>
                <p class="mb-4 text-2xl font-bold text-blue-600"><?= htmlspecialchars($produit['prix']) ?> €</p>
                <p class="text-gray-700">En stock : <?= htmlspecialchars($produit['en_stock']) ?></p>
                <div class="mt-6">
                    <button class="px-6 py-3 text-white bg-green-500 rounded hover:bg-green-600">Ajouter au panier</button>
                </div>
            </div>
        </div>
    </div>
</body>
