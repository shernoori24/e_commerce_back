<?php
require_once __DIR__ . '/../Utils/FacturePDF.php';

$commande_id = $_GET['id'] ?? null;

if ($commande_id) {
    echo '<a href="/assets/factures/facture_' . $commande_id . '.pdf" download>Télécharger la facture</a>';
} else {
    echo "Aucune commande trouvée.";
}