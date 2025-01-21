<?php
include './includes/header.php';

if (!isset($_GET['route']) || empty($_GET['route'])) {
    $maRoute = [];
} else {
    $maRoute = explode('/', $_GET['route']);
}
if (!isset($maRoute[0]) || $maRoute[0] == '' || $maRoute[0] == 'accueil') {
    include 'views/accueil.php';

}else if ($maRoute[0] == 'profil') {

    if (!isset($maRoute[1]) ||  $maRoute[1] == '') {

        include 'views/profil/profil.php';

    }else if ($maRoute[1] = 'modif_mp'){
        
        include 'views/profil/modif_mp.php';
    }
    else {
        include 'views/404.php';
    }

}else if ($maRoute[0] == 'panier') {
    include 'php/p_panier.php';
    include 'php/p_commande.php';
    include 'views/panier/panier.php';

}else if ($maRoute[0] == 'connexion') {

    include 'controllers/Connexion.php';

}

else if ($maRoute[0] == 'produits') {
    if (!isset($maRoute[1]) || ($maRoute[1] == 'toutes' || $maRoute[1] == '')) {
        include 'views/produits/produits.php';
    }
    else {
        include 'views/404.php';
    }

}else if (isset($_SESSION['user_role']) ) {
    if ( $_SESSION['user_role'] === 'Admin' && $maRoute[0] == 'admin'){
        include 'controllers/admin.php';
    }else {
    include 'views/404.php';
    } 
}

include './includes/footer.html';