<?php
include("../config/conexion.php");
$conexion = conectarDB();

// SOLUCIÓN PARA ESPACIOS: Reemplaza los espacios vacíos por guiones bajos (_)
$nombre_limpio = str_replace(' ', '_', $_FILES['imagen']['name']);

// Unimos el timestamp único con el nombre limpio sin espacios
$nombre = time() . "_" . $nombre_limpio;
$ruta = "../uploads/" . $nombre;

// Movemos el archivo físico temporal a la carpeta de uploads con el nombre limpio
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

$usuario_id = $_POST['usuario_id'] ?? 1;

try {
    $sql_m = "INSERT INTO imagenes (nombre, ruta, usuario_id) VALUES (?, ?, ?)";
    $stmt_m = $conexion->prepare($sql_m);
    
    if ($stmt_m->execute([$nombre, $ruta, $usuario_id])) {
        echo "OK"; 
    } else {
        echo "Error en MariaDB";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>