<?php

require 'models/Database.php'; 

function getProduits() {
    $conn = getConnection();
    if ($conn === null) {
        return [];
    }
    try {
        $sql = "SELECT * FROM produits";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Query failed: " . $e->getMessage();
        return [];
    } finally {
        $conn = null;
    }
    return $produits;
}