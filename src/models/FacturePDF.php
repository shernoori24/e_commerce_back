<?php
namespace Models;

use TCPDF;

class FacturePDF extends TCPDF {
    private $commande_id;
    private $email;
    private $adresse;

    public function __construct($commande_id, $email, $adresse) {
        parent::__construct();
        $this->commande_id = $commande_id;
        $this->email = $email;
        $this->adresse = $adresse;
    }

    public function generate() {
        $this->AddPage();
        $this->SetFont('dejavusans', 'B', 16);
        
        // En-tête de la facture
        $this->Cell(0, 10, 'Jonline', 0, 1, 'C');
        $this->Ln(10);
        
        $this->SetFont('dejavusans', 'B', 14);
        $this->Cell(0, 10, 'FACTURE', 0, 1, 'C');
        $this->Ln(10);
        
        $this->SetFont('dejavusans', '', 12);
        $this->Cell(40, 10, 'Envoye a:');
        $this->Cell(0, 10, $this->adresse, 0, 1);
        $this->Ln(10);
        
        $this->Cell(40, 10, 'Facture #' . $this->commande_id);
        $this->Ln(10);
        $this->Cell(40, 10, 'Date : ' . date('d/m/Y H:i:s'));
        $this->Ln(10);
        $this->Cell(40, 10, 'Email : ' . $this->email);
        $this->Ln(20);

        // Détails de la commande
        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(40, 10, 'Produit');
        $this->Cell(40, 10, 'Quantité');
        $this->Cell(40, 10, 'Prix unitaire');
        $this->Cell(40, 10, 'Total');
        $this->Ln();

        // Récupérer les produits de la commande
        $commandeModel = new \Models\Commandes();
        $produits = $commandeModel->getProduitsCommande($this->commande_id);

        $this->SetFont('dejavusans', '', 12);
        foreach ($produits as $produit) {
            $this->Cell(40, 10, $produit['nom']);
            $this->Cell(40, 10, $produit['quantite']);
            $this->Cell(40, 10, $produit['prix'] . ' €');
            $this->Cell(40, 10, ($produit['prix'] * $produit['quantite']) . ' €');
            $this->Ln();
        }

        // Total
        $this->Ln(10);
        $this->SetFont('dejavusans', 'B', 12);
        $this->Cell(120, 10, 'Total General');
        $total = array_reduce($produits, function($carry, $item) {
            return $carry + ($item['prix'] * $item['quantite']);
        }, 0);
        $this->Cell(40, 10, $total . ' €', 0, 1);

        // Générer le PDF
        $file = __DIR__ . '/../assets/factures/facture_' . $this->commande_id . '.pdf';
        $this->Output($file, 'F');
    }
}