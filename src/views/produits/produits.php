<?php
// Démarrage de la session

// Inclusion du modèle Produits
require 'models/Produits.php';

// Instanciation de la classe Produits
$produits = new Produits();

// Récupération de tous les produits
$results = $produits->getProduits();

// Gestion de l'ajout au panier
if (isset($_GET['action']) && $_GET['action'] == 'ajouter-au-panier') {
    // Validation de l'ID du produit
    if (isset($_GET['id_produit']) && is_numeric($_GET['id_produit'])) {
        $id_produit = (int)$_GET['id_produit'];
        $id_utilisateur = $_SESSION['user_id'];
        $produits->ajouterAuPanier($id_produit, $id_utilisateur);
        header("Location: produits");
        exit;
    }
}
?>


<div class="container mx-auto p-4">


    <h2 class="text-3xl text-gray-900 capitalize">All <span class="text-red-600">Products</span></h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php foreach ($results as $product): ?>
        <div class="border p-4 rounded-lg flex flex-col items-center">
            <!-- Image du produit -->
            <img src="<?= htmlspecialchars($product['photo']) ?>" alt="<?= htmlspecialchars($product['nom']) ?>"
                class="mb-4 w-48 h-48 object-cover">

            <!-- Nom du produit -->
            <h2 class="text-xl font-bold mb-2"><?= htmlspecialchars($product['nom']) ?></h2>

            <!-- Description du produit -->
            <p class="mb-2"><?= htmlspecialchars($product['description']) ?></p>

            <!-- Prix du produit -->
            <p class="mb-4 font-semibold"><?= htmlspecialchars($product['prix']) ?>€</p>



            <!-- Bouton pour ajouter au panier -->
            <?php if ($produits->estDansPanier($product['id'], $_SESSION['user_id'])): ?>
            <!-- Bouton désactivé si le produit est déjà dans le panier -->
            <button class="bg-gray-400 text-white px-4 py-2 rounded cursor-not-allowed" disabled
                aria-label="Produit déjà dans le panier">
                Ajouté au panier
            </button>
            <?php else: ?>
            <!-- Formulaire pour ajouter au panier -->
            <form action="produits" method="GET" class="inline">
                <input type="hidden" name="action" value="ajouter-au-panier">
                <input type="hidden" name="id_produit" value="<?= htmlspecialchars($product['id']) ?>">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                    aria-label="Ajouter au panier">
                    Ajouter au panier
                </button>
            </form>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>