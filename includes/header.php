<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <base href="http://localhost/projets/e_commerce_back/">
    <link rel="stylesheet" href="./assets/css/main.css">
      
    <link rel="icon" type="image/png" href="./assets/img/logo.png">

    <!-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> -->
    <title>E commerce</title>
</head>
<body>

<header>

<!-- navbar  -->
<nav class="navbar" id="navbar">
    <div class="brand">
        <a href="index"><img src="assets/img/logo.png" alt="logo" class="logo"></a>

        <a href="index">Jonline</a>
    </div>
    <ul class="nav-links" id="navLinks">
        <li><a href="index" class="active">Accueil</a></li>
        <li><a href="produits">produits</a></li>
        

        <?php if (isset($_SESSION['user_id'])): ?> 
            
            <li><a href="panier">Mon Panier</a></li>
            
        <?php if ($_SESSION['user_role'] === 'Admin'): ?>
            
            <li><a href="backOffice/admin.html">admin</a></li>
             
        <?php endif; ?>
        
        <li class="dropdown">  
                <a class="dropbtn"><img width="30" src="<?php echo $_SESSION['user_photo_profil']; ?>" alt="<?php echo $_SESSION['user_nom']; ?>"></a>
                <div class="dropdown-content">
                    <a href=""><?php echo $_SESSION['user_nom']; ?></a>
                    <a href="profil">profil</a>
                    <a href="php/logout.php">Se Déconnecter</a>
                </div>
        </li>
        <?php else: ?>
            <li><a href="connexion/login">Se Connecter</a></li>
        <?php endif; ?>
    </ul>
    <!-- Burger menu -->
    <div class="burger" id="burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>
<div class="progress-bar">
    <div class="progress"></div>
</div>
<!-- button scroll up -->
<button id="scrollToTopBtn" class="scroll-to-top">↑</button>
<script src="assets/js/header.js"></script>
</header>