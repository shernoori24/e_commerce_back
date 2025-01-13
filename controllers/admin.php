<div class="admin-container">
    <aside class="sidebar">
        <br><br><br>
        <ul class="active-link">
            <li><a href="admin/recettes" id="recettes-link">Recettes</a></li>
            <li><a href="admin/ingredients" id="ingredients-link">Ingrédients</a></li>
            <li><a href="admin/utilisateurs" id="utilisateurs-link">Utilisateurs</a></li>
        </ul>
    </aside>
    <div class="main-content">

        <?php
        if (!isset($maRoute[0]) || $maRoute[0] == 'admin' || $maRoute[0] == '') {
            if (isset($maRoute[1]) || $maRoute == '') {
                switch ($maRoute[1])     {
                    case '':
                        echo '<h1>Bienvenu Admin</h1>';
                        break;
                    case 'recettes':
                        // tous les recettes
                        if (!isset($maRoute[2]) || $maRoute[2] == 'tous' || $maRoute[2] == '') {
                            include 'views/admin/recettes/recettes.php';
                        } else if (is_numeric($maRoute[2])) {
                            
                            include 'views/admin/recettes/une_recette.php';
                            echo '<hr>';
                            include 'views/admin/recettes/modif_une_recette.php';
                        } else {
                            include 'views/404.php';
                        }
                        break;
                    case 'ingredients':
                        if (!isset($maRoute[2]) || $maRoute[2] == 'tous' || $maRoute[2] == '') {
                            require 'php/admin/Ingredients.php';
                            include 'views/admin/ingredients/ingredients.php';
                        } else if (is_numeric($maRoute[2])) {
                            
                            include 'views/admin/ingredients/une_ingredient.php';
                        }else if ($maRoute[2] == 'ajouter') {
                            require 'php/admin/Ingredients.php';
                            include 'views/admin/ingredients/ajoute_ingredient.php';
                        }else if ($maRoute[2] == 'modif') {
                            require 'php/admin/Ingredients.php';
                            include 'views/admin/ingredients/modif_ingredient.php';
                        }
                         else {
                            include 'views/404.php';
                        }
                        break;
                    case 'utilisateurs':
                        if (!isset($maRoute[2]) || $maRoute[2] == 'tous' || $maRoute[2] == '') {
                            include 'views/admin/utilisateurs/utilisateurs.php';
                        } else if (is_numeric($maRoute[2])) {
                            
                            include 'views/admin/utilisateurs/une_utilisateur.php';
                        }else if ($maRoute[2] == 'ajouter') {
                            
                            include 'views/admin/utilisateurs/ajoute_utilisateur.php';
                        }else if ($maRoute[2] == 'modif') {
                            
                            include 'views/admin/utilisateurs/modif_utilisateur.php';
                        }
                         else {
                            include 'views/404.php';
                        }
                        break;
                    default:
                        include 'views/404.php';
                        break;
                }
            }else {
                echo '<h1>Bienvenu Admin</h1>';
            }
        }
        ?>
    </div>

</div>
