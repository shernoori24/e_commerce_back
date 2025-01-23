<?php

    // C'est la classe PHP qui est responsable d'aller chercher les données en SQL et de les
    // donner au contrôleur PHP (le conseiller Carrefour)

    namespace Models;

    class MagasinierEntrepot extends ModeleParent {

        public function get_all_articles() {

            // On prépare, exécute et récupère le résultat d'une requête SQL
            $requete = $this->pdo->prepare("
                SELECT *
                FROM produits");
            $requete->execute();
            $data = $requete->fetchAll();

            return $data;

        }

    }

?>