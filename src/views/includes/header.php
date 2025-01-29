<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="http://localhost/projets/e_commerce_back/">
    <link rel="stylesheet" href="./src/assets/css/output_style.css">
    <link rel="stylesheet" href="./src/assets/css/main.css">
    <link rel="icon" type="image/png" href="src/assets/img/logo.png">
    <title>E commerce site</title>
    <script src="src/assets/js/panier.js"></script>
</head>

<body>
    <header>
        <!-- Navbar -->
        <nav class="navbar" id="navbar">
            <div class="brand">
                <a href="index"><img src="src/assets/img/logo.png" alt="logo" class="logo"></a>
                <a href="index">Jonline</a>
            </div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index">
                        <lord-icon src="https://cdn.lordicon.com/rpvomrgr.json" trigger="hover"
                            state="hover-partial-roll" style="width:50px;height:50px">
                        </lord-icon>
                    </a></li>
                <li>
                    <!-- produits icon  -->
                    <a href="produits">
                        <lord-icon src="https://cdn.lordicon.com/nijzsrfc.json" trigger="hover"
                            style="width:50px;height:50px">
                        </lord-icon>
                    </a></li>

                <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="panier">
                        <!-- panier icon  -->
                        <lord-icon src="https://cdn.lordicon.com/jprtoagx.json" trigger="hover" stroke="bold"
                            colors="primary:#121331,secondary:#66a1ee" style="width:50px;height:50px">
                        </lord-icon>
                    </a></li>
                <?php if ($_SESSION['user_role'] === 'Admin'): ?>
                <li><a href="admin">
                        <!-- admin icon  -->
                        <lord-icon src="https://cdn.lordicon.com/xtkytdlz.json" trigger="hover"
                            style="width:50px;height:50px">
                        </lord-icon>
                    </a></li>
                <?php endif; ?>
                <li class="dropdown">
                    <a class="dropbtn">
                        <img width="30" src="<?php echo $_SESSION['user_photo_profil']; ?>"
                            alt="<?php echo $_SESSION['user_nom']; ?>">
                    </a>
                    <div class="dropdown-content">
                        <a href=""><?php echo $_SESSION['user_nom']; ?></a>
                        <a href="profil">Profil</a>
                        <a href="src/php/logout.php">Se Déconnecter</a>
                    </div>
                </li>
                <?php else: ?>
                <li><a href="connexion/login">Se Connecter</a></li>
                <?php endif; ?>
            </ul>
            <!-- Burger Menu -->
            <div class="burger" id="burger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
        <div class="progress-bar">
            <div class="progress"></div>
        </div>
        <!-- Scroll-to-top button -->
        <button id="scrollToTopBtn" class="scroll-to-top">↑</button>
        <script src="src/assets/js/header.js"></script>
    </header>