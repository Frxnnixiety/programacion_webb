<?php
// db-pgsql.php

function conectarPostgres() {
    $host = "127.0.0.1";        // Cambiado de localhost a la IP local para Postgres
    $port = "5432";
    $db   = "galeria_postgres"; // Tu base de datos limpia
    $user = "ffuentes";         // Tu usuario real
    $pass = "frxn085";         // Tu contraseña real

    // El DSN cambia el prefijo a 'pgsql'
    $dsn = "pgsql:host=$host;port=$port;dbname=$db";

    try {
        // Creamos la instancia de PDO
        $pdo = new PDO($dsn, $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);

        return $pdo;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>