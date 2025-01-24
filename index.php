<?php
include './src/views/includes/header.php';


    // On appelle l'autoloader de Composer
    require_once("./vendor/autoload.php");

    // Appel de la bibliothèque Dotenv
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    // Appel du routeur
    require "./routeur.php" ;

include './src/views/includes/footer.html';