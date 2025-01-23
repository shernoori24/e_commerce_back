<?php
require_once 'models/Produits.php';

$produits = new Produits();
$panier = $produits->getPanier($_SESSION['user_id']);

?>

<div class="container mx-auto p-4">
    <h2 class="text-3xl font-bold text-gray-900 mb-6">Votre Panier</h2>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Modifier quantité</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix total</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
                <tbody>
                    
                
                <?php
                $prix_totol_pour_commander = 0;
                foreach ($panier as $item): 
                    $prix_totol_pour_commander += ($item['prix'] * $item['quantite']);
                    
                    
                    ?>
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 text-sm text-gray-900"><img width="30" src="<?= htmlspecialchars($item['photo']) ?>" alt="<?= htmlspecialchars($item['nom']) ?>"></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['nom']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?= htmlspecialchars($item['description']) ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlspecialchars($item['prix']) . '€' ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                    <form action="" method="post">
                        <input type="hidden" name="produit_id" value="<?= $item['produit_id'] ?>">
                        <input type="hidden" name="utilisateur_id" value="<?= $item['utilisateur_id'] ?>">
                        <input type="number" name="quantite" min="1" value="<?= $item['quantite'] ?>" class="w-full p-2 pl-10 text-sm text-gray-700 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:border-transparent">
                        <button type="submit" class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">Modifier la quantité</button>
                    </form>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-900"><?php echo htmlspecialchars($item['prix']) * $item['quantite'] . '€' ?></td>
                    <td class="px-6 py-4 text-sm text-gray-900">
                    <form action="" method="post">
                        <input type="hidden" name="supprimer" value="<?= $item['produit_id'] ?>">
                        <input type="hidden" name="utilisateur_id" value="<?= $item['utilisateur_id'] ?>">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Supprimer</button>
                    </form>
                </tr>
                <?php endforeach; 
                
                ?>
            </tbody>
        </table>
    </div>
</div>


<h2>Tatale : <?php echo htmlspecialchars($prix_totol_pour_commander) . '€' ?></h2>

<form action="" method="post">
  <input class="bg-orange-500 hover:bg-orange-700 text-white font-bold py-2 px -4 rounded" type="submit" name="commander" value="Commander">
</form>