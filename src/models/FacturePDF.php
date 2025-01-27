<?php
namespace Models;

use FPDF;

class FacturePDF extends FPDF {
    private $commande_id;

    public function __construct($commande_id) {
        parent::__construct();
        $this->commande_id = $commande_id;
    }

    public function generate() {
        $this->AddPage();
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(40, 10, 'Facture #' . $this->commande_id);
        $this->Ln(20);

        // Ajouter les détails de la commande
        $this->SetFont('Arial', '', 12);
        $this->Cell(40, 10, 'Produit');
        $this->Cell(40, 10, 'Quantité');
        $this->Cell(40, 10, 'Prix unitaire');
        $this->Cell(40, 10, 'Total');
        $this->Ln();

        // Récupérer les produits de la commande
        $commandeModel = new \Models\Commandes();
        $produits = $commandeModel->getProduitsCommande($this->commande_id);

        foreach ($produits as $produit) {
            $this->Cell(40, 10, $produit['nom']);
            $this->Cell(40, 10, $produit['quantite']);
            $this->Cell(40, 10, $produit['prix'] . ' €');
            $this->Cell(40, 10, ($produit['prix'] * $produit['quantite']) . ' €');
            $this->Ln();
        }

        // Générer le PDF
        $this->Output('F', 'src/assets/factures/facture_' . $this->commande_id . '.pdf');
    }
}