<?php

    namespace Controllers;

    class ConseillerCarrefour {

        public function get_all_articles() {

            $magasinier_entrepot = new \Models\MagasinierEntrepot;
            $data = $magasinier_entrepot->get_all_articles();

            return $data;

        }

        public function get_all_articles_and_return_html_list() {

            $data = $this->get_all_articles();
            var_dump($data);
            die;

            // On va traiter les données pour mettre en variable une liste HTML qui sera appelée dans la vue
            // On affiche la vue HTML qui contient les données

            // Variable qui contiendra tout le code HTML dépendant des données des articles
            $codeHTMLdynamique = "<ul>";

            foreach ($data as $key => $value) {
                // var_dump($key);
                $codeHTMLdynamique .= "<li>" . $value["lib_article"]
                . "<ul><li>Description : " . $value["description"] . "</li>"
                . "<li>Prix : " . $value["prix"] . "</li>"
                . "<li>Quantité en stock : " . $value["quantite_stock"] . "</li>"
                . "<li>Date d'ajout de l'article : " . $value["date_creation"] . "</li>"
                . "<li>Dernière MAJ de l'article : " . $value["date_maj"] . "</li>"
                . "<li>Catégorie de l'article : " . $value["lib_categorie"] . "</li><br></ul>";
            }

            $codeHTMLdynamique .= "</ul>";

            return $codeHTMLdynamique;

        }

        public function insert_one_article() {
            // 
        }

        public function afficher_infos_article() {
            // 
        }

    }
?>