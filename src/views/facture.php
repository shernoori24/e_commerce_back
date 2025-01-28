<?php
$commande_id = $_GET['id'] ?? null;

if ($commande_id) {
    echo '<a href="src/assets/factures/facture_' . $commande_id . '.pdf" download>Télécharger la facture</a>';
} else {
    echo "Aucune commande trouvée.";
}