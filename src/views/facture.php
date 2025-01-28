<?php
$commande_id = $_GET['id'] ?? null;

if ($commande_id) {
    echo '<a href="src/assets/factures/facture_' . $commande_id . '.pdf" download>Télécharger la facture</a>';
} else {
    echo "Aucune commande trouvée.";
}

?>

<script async src="https://js.stripe.com/v3/buy-button.js"></script>

<!--
Dans le code ci-dessous, les valeurs des attributs "buy-button-id" et "publishable-key" sont à remplacer avec celles
de la balise similaire que vous pouvez obtenir sur la page de votre lien de paiement de test dans votre Dashboard Stripe.
 -->
<stripe-buy-button
buy-button-id="buy_btn_1QkX4vCSJ99AYCrcTTIAuiTn"
publishable-key="pk_test_51Qeec2CSJ99AYCrcLvEZ5K3fA0UJ5KFv8WoHcBOfQbWcPMei1utFnQl96jq2eVdh94vxAtuIcfrPFO9oOyHYXqNz00gbBD4QrW"
>
</stripe-buy-button>