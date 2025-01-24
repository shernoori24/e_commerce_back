<?php
$error = $_SESSION['error_inscription'] ?? '';
unset($_SESSION['error_inscription']); // Supprimer l'erreur après l'avoir affichée
?>

<body class="bg-gray-100">
    <div class="container px-4 py-8 mx-auto">
        <h1 class="mb-8 text-3xl font-bold text-center">Inscription</h1>
        <?php if ($error): ?>
            <div class="px-4 py-3 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        <form action="" method="POST" class="max-w-md p-6 mx-auto bg-white rounded-lg shadow-md">
            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom</label>
                <input type="text" name="nom" id="nom" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <div class="mb-4">
                <label for="mot_de_passe" class="block text-gray-700">Mot de passe</label>
                <input type="password" name="mot_de_passe" id="mot_de_passe" required class="w-full px-4 py-2 border rounded-lg">
            </div>
            <button type="submit" class="w-full px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">S'inscrire</button>
        </form>
    </div>
</body>