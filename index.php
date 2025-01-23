<?php
include './src/views/includes/header.php';


    // On appelle l'autoloader de Composer
    require_once("./vendor/autoload.php");

    // Appel de la bibliothèque Dotenv
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    // Appel du routeur
    require("./routeur.php");




// router

if (!isset($_GET['route']) || empty($_GET['route'])) {
    $maRoute = [];
} else {
    $maRoute = explode('/', $_GET['route']);
}
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
    include 'src/php/p_panier.php';
    include 'src/php/p_commande.php';
    include 'src/views/panier/panier.php';

// test
}else if ($maRoute[0] == 'articles') {
    // On récupère les données de tous les articles
    $conseiller_carrefour = new Controllers\ConseillerCarrefour;
    $codeHTMLdynamique = $conseiller_carrefour->get_all_articles_and_return_html_list();

    // On appelle la vue de la page de tous les articles
    include("./src/views/tous_les_article.php");

}else if ($maRoute[0] == 'connexion') {

    include 'src/controllers/Connexion.php';

}

else if ($maRoute[0] == 'produits') {
    if (!isset($maRoute[1]) || ($maRoute[1] == 'toutes' || $maRoute[1] == '')) {
        include 'src/views/produits/produits.php';
    }
    else {
        include 'src/views/404.php';
    }

}else if (isset($_SESSION['user_role']) ) {
    if ( $_SESSION['user_role'] === 'Admin' && $maRoute[0] == 'admin'){
        include 'src/controllers/admin.php';
    }else {
    include 'src/views/404.php';
    } 
}


include './src/views/includes/footer.html';

