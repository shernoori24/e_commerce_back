<?php

if (!isset($maRoute[1]) || ($maRoute[1] == 'toutes' || $maRoute[1] == '')) {
    include 'views/produits/produits.php';


}else if (is_numeric($maRoute[1])){
    $id_recette_demande = $maRoute[1];
    
    require 'models/Database.php';
    require 'models/Recette.php';
    $recette_trouve = Recette::getRecetteById($id_recette_demande);
    if ( $recette_trouve == true
    // && sizeof($recette_trouve) > 0
    ) {
        
        include 'views/recettes/une_recette.php';
        
    } else {
        include "./views/404.php";
    }
}
else {
    include 'views/404.php';
}