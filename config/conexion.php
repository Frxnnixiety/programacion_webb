<?php
// conexion.php

$host = "127.0.0.1";        // Tu servidor local de Postgres
$port = "5432";             // Puerto oficial de PostgreSQL
$db   = "galeria_postgres"; // Tu base de datos limpia y asignada a tu usuario
$user = "ffuentes";         // Tu usuario real de Postgres
$pass = "frxn085";         // Tu contraseña real

$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    // Creamos la conexión directa usando PDO con el controlador de PostgreSQL
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    // Creamos un alias por si tus otros archivos PHP mandan a llamar a la conexión
    // usando la variable $conexion en lugar de $pdo
    $conexion = $pdo;

} catch (PDOException $e) {
    die("Error de conexión con PostgreSQL: " . $e->getMessage());
}
?>