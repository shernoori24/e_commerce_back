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


}else if ($maRoute[0] == 'mes-recettes') {

    include 'views/recettes/mes_recettes.php';



}else if ($maRoute[0] == 'connexion') {

    include 'controllers/Connexion.php';

}



else if ($maRoute[0] == 'produits') {

    include 'controllers/produits.php';

    
}else if ($maRoute[0] == 'ingredients') {

    include 'controllers/Ingredients.php';

    
}else if (isset($_SESSION['user_role']) ) {
    if ( $_SESSION['user_role'] === 'Administrateur' && $maRoute[0] == 'admin'){
        include 'controllers/admin.php';
    }else {
    include 'views/404.php';
    } 
}

include './includes/footer.html';