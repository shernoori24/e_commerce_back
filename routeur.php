<?php
    // router
    if (!isset($_GET['route']) || empty($_GET['route'])) {
        $maRoute = [];
    } else {
        $maRoute = explode('/', $_GET['route']);
    }

    // deriger les itinéraire
    if (!isset($maRoute[0]) || $maRoute[0] == '' || $maRoute[0] == 'accueil') {
        include 'src/views/accueil.php';

    }else if ($maRoute[0] == 'profil') {

        if (!isset($maRoute[1]) ||  $maRoute[1] == '') {

            include 'src/views/profil/profil.php';

        }else if ($maRoute[1] = 'modif_mp'){
            
            include 'src/views/profil/modif_mp.php';
        }
        else {
            include 'src/views/404.php';
        }

    }else if ($maRoute[0] == 'panier') {
        require_once 'src/models/Produits.php';
        include 'src/views/panier/panier.php';

    // test
    }else if ($maRoute[0] == 'connexion') {

        include 'src/controllers/Connexion.php';

    }

    else if ($maRoute[0] == 'produits') {
        if (!isset($maRoute[1]) || ($maRoute[1] == 'toutes' || $maRoute[1] == '')) {
            // Afficher tous les produits
            $produitsController = new Controllers\ProduitsController();
            $affich_produits = $produitsController->getAllProduits();
            include 'src/views/produits/produits.php';
        } else if (is_numeric($maRoute[1])) {
            // Afficher les détails d'un produit spécifique
            $id_produit = $maRoute[1];
            $produitsController = new Controllers\ProduitsController();
            $produit_trouve = $produitsController->getProduitById($id_produit);
            if ($produit_trouve) {
                include 'src/views/produits/detail.php';
            } else {
                include 'src/views/404.php';
            }
        } else {
            include 'src/views/404.php';
        }
    }else if (isset($_SESSION['user_role']) ) {
        if ( $_SESSION['user_role'] === 'Admin' && $maRoute[0] == 'admin'){
            include 'src/controllers/admin.php';
        }else {
        include 'src/views/404.php';
        } 
    }