async function ajouterAuPanier(id, nom, prix, photo) {
    // Récupérer la quantité en stock
    const response = await fetch(`./src/php/getStock.php?id=${id}`);
    const data = await response.json();
    const stockDisponible = data.stock;


    // Récupérer le panier actuel
    let panier = JSON.parse(localStorage.getItem('panier')) || [];
    let produitExistant = panier.find(p => p.id === id);

    if (produitExistant) {
        // Vérifier si la quantité demandée dépasse le stock disponible
        if (produitExistant.quantite + 1 > stockDisponible) {
            alert("La quantité demandée dépasse le stock disponible.");
            return;
        }
        // Augmenter la quantité
        produitExistant.quantite += 1;
    } else {
        // Vérifier si la quantité demandée dépasse le stock disponible
        if (1 > stockDisponible) {
            alert("La quantité demandée dépasse le stock disponible.");
            return;
        }
        // Ajouter le produit au panier
        panier.push({ id, nom, prix, photo, quantite: 1 });
    }

    localStorage.setItem('panier', JSON.stringify(panier));
    alert("Produit ajouté au panier !");
}