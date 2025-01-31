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
    public function showProduitCategorie() {
        // Récupérer les catégories depuis la base de données
        $categories =  $this->produitsModel->getCategories() ;
        
        return $categories;
        // return
        
        
    }

    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $data = [
                'nom' => $_POST['nom'],
                'prix' => $_POST['prix'],
                'en_stock' => $_POST['en_stock'],
                'description' => $_POST['description'],
                'categorie_id' => $_POST['categorie_id'],
                'new_categorie' => $_POST['new_categorie'],
                'photo' => $_FILES['photo']
            ];
    
            // Gérer la nouvelle catégorie si elle est fournie
            if (!empty($data['new_categorie'])) {
                $newCategorieId = $this->produitsModel->addCategorie($data['new_categorie']);
                $data['categorie_id'] = $newCategorieId;
            }
    
            // Gérer l'upload de la photo
            $photoPath = $this->uploadPhoto($data['photo']);
            $data['photo'] = $photoPath;
    
            // Ajouter le produit à la base de données
            $this->produitsModel->addProduit($data);
    
            // Rediriger vers la page admin
            header('Location: articles');
            exit();
        }
   }
    
    private function uploadPhoto($file) {
        $targetDir = "src/assets/img/produits/";
        $targetFile = $targetDir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $targetFile)) {
            return $targetFile;
        } else {
            throw new \Exception("Erreur lors de l'upload de la photo.");
        }
    }

    public function editProduct($id) {
        // Récupérer les détails du produit
        $produit = $this->produitsModel->getProduit($id);
    
        // Récupérer les catégories pour le formulaire
        $categories = $this->produitsModel->getCategories();
    
        // Afficher la vue avec le formulaire de modification
        include 'src/views/admin/menu/edit_product.php';
    }
 }