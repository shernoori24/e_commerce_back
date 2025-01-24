<?php
// Récupérer les produits depuis le contrôleur
$produits = $affich_produits;
?>




<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center">Nos Produits</h1>
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
            <?php foreach ($produits as $produit): ?>
                <div class="overflow-hidden bg-white rounded-lg shadow-md">
                    <img src="<?= htmlspecialchars($produit['photo']) ?? 'src/assets/img/produits/defaut.png' ?>" alt="<?= htmlspecialchars($produit['nom']) ?>" class="object-cover w-full h-48">
                    <div class="p-4">
                        <h2 class="mb-2 text-xl font-semibold"><?= htmlspecialchars($produit['nom']) ?></h2>
                        <p class="mb-4 text-gray-700"><?= htmlspecialchars($produit['description']) ?></p>
                        <p class="text-lg font-bold text-blue-600"><?= htmlspecialchars($produit['prix']) ?> €</p>
                        <p class="text-gray-700">En stock : <?= htmlspecialchars($produit['en_stock']) ?></p>
                        <div class="flex items-center justify-between mt-4">
                            <button onclick="ajouterAuPanier(<?= $produit['id'] ?>, '<?= $produit['nom'] ?>', <?= $produit['prix'] ?>, '<?= $produit['photo'] ?>')" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Ajouter au panier</button>
                            
                            <a href="produits/<?= htmlspecialchars($produit['id']) ?>" class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">Voir plus</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        // Fonction pour ajouter un produit au panier
        function ajouterAuPanier(id, nom, prix, photo) {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let produitExistant = panier.find(p => p.id === id);

            if (produitExistant) {
                produitExistant.quantite += 1;
            } else {
                panier.push({ id, nom, prix, photo, quantite: 1 });
            }

            localStorage.setItem('panier', JSON.stringify(panier));
            alert("Produit ajouté au panier !");
        }
    </script>
</body>
