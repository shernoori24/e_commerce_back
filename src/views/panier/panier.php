    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center">Mon Panier</h1>
        <div id="panier" class="grid grid-cols-1 gap-4">
            <!-- Les produits du panier seront ajoutés ici dynamiquement -->
        </div>
        <div class="mt-8 text-right">
            <p class="text-xl font-bold">Total : <span id="total">0</span> €</p>
            <form action="" method="POST" id="form-commande">
                <div class="mb-4">
                    <label for="adresse" class="block text-gray-700">Adresse :</label>
                    <input type="text" name="adresse" id="adresse" required class="w-full p-2 mt-1 border rounded">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">E-mail :</label>
                    <input type="email" name="email" id="email" required class="w-full p-2 mt-1 border rounded">
                </div>
                <button type="submit" class="px-6 py-2 mt-4 text-white bg-blue-500 rounded hover:bg-blue-600">Passer la commande</button>
            </form>
        </div>
    </div>

    <script>
        // Fonction pour afficher les produits du panier
        function afficherPanier() {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let panierContainer = document.getElementById('panier');
            let totalElement = document.getElementById('total');
            let formCommande = document.getElementById('form-commande');

            // Vider le contenu actuel
            panierContainer.innerHTML = '';

            if (panier.length === 0) {
                // Si le panier est vide
                panierContainer.innerHTML = "<p class='text-center'>Votre panier est vide.</p>";
                totalElement.textContent = "0";
            } else {
                let html = '';
                let total = 0;

                panier.forEach((produit, index) => {
                    total += produit.prix * produit.quantite;
                    html += `
                        <div class="flex flex-col items-center p-4 bg-white rounded-lg shadow-md w-72">
                            <img src="${produit.photo}" alt="${produit.nom}" class="object-cover w-full h-32 mb-4">
                            <h2 class="text-xl font-semibold">${produit.nom}</h2>
                            <p class="text-gray-700">Prix unitaire : ${produit.prix} €</p>
                            <div class="flex items-center mt-2">
                                <button onclick="modifierQuantite(${produit.id}, -1)" class="px-2 py-1 text-gray-700 bg-gray-300 rounded-l">-</button>
                                <span class="px-4">${produit.quantite}</span>
                                <button onclick="modifierQuantite(${produit.id}, 1)" class="px-2 py-1 text-gray-700 bg-gray-300 rounded-r">+</button>
                            </div>
                            <p class="text-lg font-bold">Total : ${produit.prix * produit.quantite} €</p>
                            <button onclick="supprimerDuPanier(${produit.id})" class="px-4 py-2 mt-4 text-white bg-red-500 rounded hover:bg-red-600">Supprimer</button>
                        </div>
                    `;

                    // Ajouter des champs cachés pour chaque produit
                    formCommande.innerHTML += `
                        <input type="hidden" name="panier[${index}][id]" value="${produit.id}">
                        <input type="hidden" name="panier[${index}][nom]" value="${produit.nom}">
                        <input type="hidden" name="panier[${index}][prix]" value="${produit.prix}">
                        <input type="hidden" name="panier[${index}][quantite]" value="${produit.quantite}">
                        <input type="hidden" name="panier[${index}][photo]" value="${produit.photo}">
                    `;
                });

                panierContainer.innerHTML = html;
                totalElement.textContent = total;
            }
        }

        // Fonction pour modifier la quantité d'un produit
        function modifierQuantite(id, delta) {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let produit = panier.find(p => p.id === id);

            if (produit) {
                produit.quantite += delta;
                if (produit.quantite <= 0) {
                    panier = panier.filter(p => p.id !== id); // Supprimer si la quantité est <= 0
                }
                localStorage.setItem('panier', JSON.stringify(panier));
                afficherPanier(); // Rafraîchir l'affichage du panier
            }
        }

        // Fonction pour supprimer un produit du panier
        function supprimerDuPanier(id) {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            panier = panier.filter(p => p.id !== id);
            localStorage.setItem('panier', JSON.stringify(panier));
            afficherPanier(); // Rafraîchir l'affichage du panier
        }

        // Afficher le panier au chargement de la page
        document.addEventListener('DOMContentLoaded', afficherPanier);
    </script>

