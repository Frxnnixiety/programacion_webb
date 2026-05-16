<?php
// Ejemplo rápido de cómo cambiaría tu PDO en la rama 'postgres-db'
function conectarDB() {
    $host = 'localhost';
    $db   = 'galeria_postgres'; // Tu nueva BD en Postgres
    $user = 'tu_usuario_postgres';
    $pass = 'tu_contraseña';
    $port = '5432'; // Puerto nativo de Postgres

    try {
        // Cambiamos el driver de 'mysql' a 'pgsql'
        $conexion = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexion;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>