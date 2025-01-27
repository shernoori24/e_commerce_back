<?php
$produits = new Models\Produits();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Récupération des informations de la commande
$commande_id = $_GET['id'];
$commande = $produits->getCommande($commande_id);
$produits_commande = $produits->getProduitsCommande($commande_id);
?>

<h2>Confirmation de votre commande</h2>
<p>Merci pour votre commande ! Voici les détails :</p>
<p>Numéro de commande : <?= $commande['id'] ?></p>
<p>Date de la commande : <?= $commande['date'] ?></p>
<p>Total : <?= $commande['total'] ?> €</p>

<h3>Produits commandés</h3>
<table>
  <thead>
    <tr>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Prix</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($produits_commande as $item) : ?>
      <tr>
        <td><?= $item['nom'] ?></td>
        <td><?= $item['quantite'] ?></td>
        <td><?= $item['prix'] ?> €</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Retour à l'accueil</a>