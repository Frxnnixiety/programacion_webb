<?php

// --- CONEXIÓN ORIGINAL MARIADB (No se toca nada) ---
$conexion = new mysqli(
    "localhost",
    "root",
    "",
    "galeria_ajax",
    3307
);

if($conexion->connect_error){
    die("Error de conexión");
}

// --- AGREGANDO CONEXIÓN POSTGRESQL ---
$host_p = 'localhost';
$port_p = '5432'; // Puerto por defecto de Postgres
$db_p   = 'galeria_ajax';
$user_p = 'postgres';
$pass_p = '123456789'; // Reemplaza con la contraseña que configuraste

try {
    // Usamos PDO para la conexión a PostgreSQL
    $pdo_postgres = new PDO("pgsql:host=$host_p;port=$port_p;dbname=$db_p", $user_p, $pass_p);
    
    // Configuramos para que lance excepciones en caso de error
    $pdo_postgres->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    // Si falla Postgres, mostramos el error (puedes cambiarlo a die si prefieres que se detenga todo)
    echo "Error en la conexión de PostgreSQL: " . $e->getMessage();
}

?>

