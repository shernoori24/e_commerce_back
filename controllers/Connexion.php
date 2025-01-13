<div class="admin-container">
    <aside class="sidebar">
        <br><br>
        <ul class="active-link">
            <li><a href="connexion/login">Login</a></li>
            <li><a href="connexion/inscription">inscriptoin</a></li>
        </ul>
    </aside>
    <div class="main-content">
        <br><br>
        <?php
        if (!isset($maRoute[0]) || $maRoute[0] == 'connexion' || $maRoute[0] == '') {
            if (isset($maRoute[1]) || $maRoute == '') {
                switch ($maRoute[1]) {
                    case '':
                        include 'views/connexion/login_form.php';
                        break;
                    case 'login':
                        include 'views/connexion/login_form.php';
                        break;
                    case 'inscription':
                        
                        include 'views/connexion/inscription_form.php';
                        break;
                    default:
                        include 'views/404.php';
                        break;
                }
            }else {
                include 'views/connexion/login_form.php';
            }
        }
        ?>
    </div>

</div>
