
<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center">Mon Panier</h1>
        <div id="panier" class="grid grid-cols-1 gap-4">
            <!-- Les produits du panier seront ajoutés ici dynamiquement -->
        </div>
        <div class="mt-8 text-right">
            <p class="text-xl font-bold">Total : <span id="total">0</span> €</p>
            <button onclick="passerCommande()" class="px-6 py-2 mt-4 text-white bg-blue-500 rounded hover:bg-blue-600">Passer la commande</button>
        </div>
    </div>

    <script>
        // Fonction pour afficher les produits du panier
        function afficherPanier() {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];
            let panierContainer = document.getElementById('panier');
            let totalElement = document.getElementById('total');

            if (panier.length === 0) {
                panierContainer.innerHTML = "<p class='text-center'>Votre panier est vide.</p>";
                totalElement.textContent = "0";
                return;
            }

            let html = '';
            let total = 0;

            panier.forEach(produit => {
                total += produit.prix * produit.quantite;
                html += `
                    <div class="p-4 bg-white rounded-lg shadow-md">
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
            });

            panierContainer.innerHTML = html;
            totalElement.textContent = total;
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

        // Fonction pour passer la commande
        async function passerCommande() {
            let panier = JSON.parse(localStorage.getItem('panier')) || [];

            if (panier.length === 0) {
                alert("Votre panier est vide.");
                return;
            }

            try {
                const response = await fetch('/src/Controller/CommandeController.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(panier)
                });

                const data = await response.json();

                if (data.success) {
                    alert("Commande passée avec succès !");
                    localStorage.removeItem('panier'); // Vider le panier
                    window.location.href = `/src/Views/facture.php?id=${data.commande_id}`; // Rediriger vers la facture
                } else {
                    alert("Erreur lors de la commande : " + data.message);
                }
            } catch (error) {
                console.error("Erreur lors de la requête :", error);
                alert("Une erreur s'est produite lors de la commande.");
            }
        }

        // Afficher le panier au chargement de la page
        document.addEventListener('DOMContentLoaded', afficherPanier);
    </script>
</body>
