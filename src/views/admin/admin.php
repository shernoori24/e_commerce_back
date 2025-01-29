<body class="flex h-screen bg-gray-100">

    <!-- Sidebar -->
    <nav class="w-64 px-4 py-8 space-y-6 text-white bg-gray-800">
        <h2 class="text-2xl font-bold">Tableau de bord</h2>
        <ul class="space-y-4">
            <li><a href="admin/states" class="block px-4 py-2 hover:bg-gray-700" data-section="stats">Stats</a></li>
            <li><a href="admin/articles" class="block px-4 py-2 hover:bg-gray-700" data-section="articles">Articles</a></li>
            <li><a href="admin/commandes" class="block px-4 py-2 hover:bg-gray-700" data-section="commandes">Commandes</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 p-6">

    <?php
        if (!isset($maRoute[0]) || $maRoute[0] == 'admin' || $maRoute[0] == '') {
            if (isset($maRoute[1]) || $maRoute == '') {
                switch ($maRoute[1]) {
                    case '':
                        echo 'include ';
                        break;
                    case 'states':
                        include 'src/views/admin/menu/states.php';
                        break;
                    case 'articles':
                        
                        include 'src/views/admin/menu/articles.php';
                        break;
                    case 'commandes':
                        
                        include 'src/views/admin/menu/commandes.php';
                        break;
                    default:
                        include 'src/views/404.php';
                        break;
                }
            }else {
                include 'src/views/admin/menu/states.php';;
            }
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <script src="src/assets/js/admin/state.js"></script> 
    <script src="src/assets/js/admin/article.js"></script> 
    <script src="src/assets/js/admin/command.js"></script> 
</body>