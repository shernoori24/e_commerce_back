let data; // Déclarer data comme une variable globale

// Initialiser le panier
function initCart() {
    if (!localStorage.getItem('cart')) {
        localStorage.setItem('cart', JSON.stringify([]));
    }
}

initCart();

// Ajouter des articles au panier
function addToCart(articleId) {
    const cart = JSON.parse(localStorage.getItem('cart'));
    if (!cart.includes(articleId)) {
        cart.push(articleId);
        localStorage.setItem('cart', JSON.stringify(cart));
        displayProducts(data.articles, cart); // Utiliser data global
        displayCart(data.articles, cart); // Utiliser data global
    }
}

// Supprimer des articles du panier
function removeFromCart(articleId) {
    const cart = JSON.parse(localStorage.getItem('cart'));
    const updatedCart = cart.filter(id => id !== articleId);
    localStorage.setItem('cart', JSON.stringify(updatedCart));
    displayProducts(data.articles, updatedCart); // Utiliser data global
    displayCart(data.articles, updatedCart); // Utiliser data global
}

// Afficher les produits
function displayProducts(articles, cart) {
    const productContainer = document.getElementById('product-container');
    productContainer.innerHTML = ''; // Clear previous content

    articles.forEach(article => {
        const productDiv = document.createElement('div');
        productDiv.classList.add('relative', 'p-5', 'transition-all', 'transform', 'hover:bg-green-100');

        // Check if the article is already in the cart
        const isInCart = cart.includes(article.id);

        productDiv.innerHTML = `
                        <img src="../image/carton.png" alt="${article.name}" width="180">
            <div class="absolute px-3 py-1 text-xs font-medium text-white uppercase bg-green-500 rounded top-3 left-3">
                Sale
            </div>
            <div class="absolute right-0 text-lg cursor-pointer hover:text-red-600">
                <i class="bx bx-heart"></i>
            </div>
            <div class="flex space-x-1 text-lg text-yellow-500">
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star"></i>
                <i class="bx bxs-star-half"></i>
            </div>
            <div class="mt-2 text-gray-900">
                <h4 class="text-lg font-medium capitalize">${article.name}</h4>
                <p class="text-sm font-semibold">$${article.price}</p>
                <button class="mt-2 px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700" onclick="addToCart(${article.id})">
                    ${isInCart ? 'Ajouté' : 'Ajouter au panier'} <i class="bx bx-cart"></i>
                </button>
                ${isInCart ? `
                    <button class="mt-2 px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="removeFromCart(${article.id})">
                        Supprimer du panier <i class="bx bx-trash"></i>
                    </button>
                ` : ''}
            </div>
        `;

        productContainer.appendChild(productDiv);
    });
}

// Afficher le panier
function displayCart(articles, cart) {
    const cartContainer = document.getElementById('cart-container');
    cartContainer.innerHTML = '<h3 class="text-xl font-semibold mb-4">Votre Panier</h3>'; // Reset le contenu

    if (cart.length === 0) {
        cartContainer.innerHTML += '<p class="text-gray-500">Votre panier est vide.</p>';
        return;
    }

    cart.forEach(articleId => {
        const article = articles.find(article => article.id === articleId);
        if (article) {
            const cartItemDiv = document.createElement('div');
            cartItemDiv.classList.add('flex', 'items-center', 'justify-between', 'p-4', 'border-b', 'border-gray-200');

            cartItemDiv.innerHTML = `
                <div class="flex items-center space-x-4">
                    <img src="../image/carton.png" alt="${article.name}" width="50">
                    <div>
                        <h4 class="text-lg font-medium">${article.name}</h4>
                        <p class="text-sm text-gray-500">$${article.price}</p>
                    </div>
                </div>
                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700" onclick="removeFromCart(${article.id})">
                    Supprimer <i class="bx bx-trash"></i>
                </button>
            `;

            cartContainer.appendChild(cartItemDiv);
        }
    });
}

// Charger les données des articles
fetch('../backOffice/assets/data/data.json')
    .then(response => response.json())
    .then(jsonData => {
        data = jsonData; // Assigner les données à la variable globale data
        const cart = JSON.parse(localStorage.getItem('cart'));
        displayProducts(data.articles, cart);
        displayCart(data.articles, cart); // Afficher la liste du panier au chargement
    })
    .catch(error => console.error('Erreur lors du chargement des données :', error));