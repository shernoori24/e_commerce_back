<?php
$commande_id = $_GET['id'] ?? null;

if ($commande_id):
?>

    <h1>🎉 Paiement réussi !</h1>
    <p>Merci pour votre commande. Vous pouvez télécharger votre facture ci-dessous :</p>
    <a href="src/assets/factures/facture_<?= htmlspecialchars($commande_id); ?>.pdf" download>
        📄 Télécharger la facture
    </a>

<?php else: ?>
    <p>Aucune commande trouvée.</p>
<?php endif; ?>
