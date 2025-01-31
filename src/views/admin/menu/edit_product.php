<div class="max-w-2xl p-6 mx-auto bg-white rounded shadow-md">
    <h1 class="mb-6 text-2xl font-bold">Modifier le produit</h1>
    <form action="/admin/updateProduct/<?= $produit['id'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
            <label class="block text-gray-700">Nom</label>
            <input type="text" name="nom" class="w-full px-3 py-2 border rounded" value="<?= htmlspecialchars($produit['nom']) ?>" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Prix (€)</label>
            <input type="number" name="prix" class="w-full px-3 py-2 border rounded" value="<?= htmlspecialchars($produit['prix']) ?>" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Stock</label>
            <input type="number" name="en_stock" class="w-full px-3 py-2 border rounded" value="<?= htmlspecialchars($produit['en_stock']) ?>" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Description</label>
            <textarea name="description" class="w-full px-3 py-2 border rounded"><?= htmlspecialchars($produit['description']) ?></textarea>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Catégorie</label>
            <select name="categorie_id" class="w-full px-3 py-2 border rounded" required>
                <option value="">Choisir une catégorie</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= $categorie['id'] ?>" <?= $categorie['id'] == $produit['categorie_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categorie['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700">Photo du produit</label>
            <input type="file" name="photo" class="w-full px-3 py-2 border rounded" accept="image/*">
            <img src="<?= htmlspecialchars($produit['photo']) ?>" alt="Photo du produit" class="object-cover w-32 h-32 mt-2">
        </div>
        <div class="flex justify-end">
            <a href="/admin" class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">Annuler</a>
            <button type="submit" class="px-4 py-2 ml-2 text-white bg-blue-500 rounded hover:bg-blue-600">Enregistrer</button>
        </div>
    </form>
</div>