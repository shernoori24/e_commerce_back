<?php
use Controllers\ProduitsController;

$produitsController = new ProduitsController();
$produits = $produitsController->getAllProduits();
$categories = $produitsController->showProduitCategorie();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produitsController->addProduct();
}

 ?>
<div id="articles">
    <h1 class="mb-4 text-3xl font-bold">Liste des Articles</h1>

    <!-- Bouton pour ouvrir la modal -->
    <button class="px-4 py-2 mb-4 text-white bg-blue-500 rounded hover:bg-blue-600"
        onclick="openModal()">Ajouter</button>

    <!-- Modal pour ajouter un produit -->
    <div id="addProductModal" class="fixed inset-0 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
        <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
            <h2 class="mb-4 text-xl font-bold">Ajouter un produit</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="mb-4">
                    <label class="block text-gray-700">Nom</label>
                    <input type="text" name="nom" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Prix (€)</label>
                    <input type="number" name="prix" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Stock</label>
                    <input type="number" name="en_stock" class="w-full px-3 py-2 border rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Description</label>
                    <textarea name="description" class="w-full px-3 py-2 border rounded"></textarea>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Catégorie</label>
                    <select name="categorie_id" class="w-full px-3 py-2 border rounded">
                        <option value="">Choisir une catégorie</option>
                        <?php if (!empty($categories)): ?>
                        <?php foreach ($categories as $categorie): ?>
                        <option value="<?= $categorie['id'] ?>"><?= htmlspecialchars($categorie['nom']) ?></option>
                        <?php endforeach; ?>
                        <?php else: ?>
                        <option value="">Aucune catégorie disponible</option>
                        <?php endif; ?>
                    </select>
                    <input type="text" name="new_categorie" class="w-full px-3 py-2 mt-2 border rounded"
                        placeholder="Ou ajouter une nouvelle catégorie">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">Photo du produit</label>
                    <input type="file" name="photo" class="w-full px-3 py-2 border rounded" accept="image/*" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Annuler</button>
                    <button type="submit"
                        class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <table class="min-w-full bg-white rounded shadow-md">
        <thead>
            <tr>
                <th class="px-4 py-2 border">ID</th>
                <th class="px-4 py-2 border">Nom</th>
                <th class="px-4 py-2 border">Catégorie</th>
                <th class="px-4 py-2 border">Prix (€)</th>
                <th class="px-4 py-2 border">Stock</th>
                <th class="px-4 py-2 border">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produits as $produit): ?>
            <tr>
                <td class="px-4 py-2 border"><?= htmlspecialchars($produit['id']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($produit['nom']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($produit['categorie_id']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($produit['prix']) ?></td>
                <td class="px-4 py-2 border"><?= htmlspecialchars($produit['en_stock']) ?></td>
                <td class="px-4 py-2 border">
                    <button class="px-2 py-1 text-white bg-green-500 rounded hover:bg-green-600"
                        onclick="alert('Voir détails')">Voir</button>
                    <button class="px-2 py-1 text-white bg-yellow-500 rounded hover:bg-yellow-600"
                        onclick="alert('Modifier')">Modifier</button>
                    <button class="px-2 py-1 text-white bg-red-500 rounded hover:bg-red-600"
                        onclick="alert('Supprimer')">Supprimer</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>


<!-- Script JavaScript pour gérer la modal -->
    <script>
        // Fermer la modal en cliquant à l'extérieur
        window.onclick = function (event) {
            const modal = document.getElementById('addProductModal');
            if (event.target === modal) {
                closeModal();
            }
        };

        function openModal() {
            document.getElementById('addProductModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('addProductModal').classList.add('hidden');
            // Réinitialiser le formulaire
            document.querySelector('form').reset();

        }
    </script>