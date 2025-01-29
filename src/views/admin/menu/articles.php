<div id="articles">
    <h1 class="mb-4 text-3xl font-bold">Liste des Articles</h1>
    <button class="px-4 py-2 mb-4 text-white bg-blue-500 rounded hover:bg-blue-600"
        onclick="alert('Ajouter un article')">Ajouter</button>
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
        <tbody id="articlesTable">
            <!-- Les lignes des articles seront ajoutées ici -->
        </tbody>
    </table>
</div>