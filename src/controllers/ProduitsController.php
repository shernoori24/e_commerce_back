<?php
namespace Controllers;
use Models\Produits;

class ProduitsController {
    private $produitsModel;

    public function __construct() {
        $this->produitsModel = new Produits();
    }

    // Récupérer tous les produits
    public function getAllProduits() {
        return $this->produitsModel->getProduits();
    }

    // Récupérer un produit par son ID
    public function getProduitById($id) {
        return $this->produitsModel->getProduit($id);
    }
}