<?php

function getConnection() {
    $servername = "localhost";
    $port = '5432'; // PostgreSQL default port
    $username = "postgres";
    $password = "postgres";
    $dbname = "e_commerce";

    try {
        // Use the PostgreSQL driver (pgsql) instead of mysql
        $conn = new PDO("pgsql:host=$servername;port=$port;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}