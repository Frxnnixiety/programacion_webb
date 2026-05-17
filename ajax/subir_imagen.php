<?php
include("../config/conexion.php");

if (!isset($conexion) && isset($pdo)) {
    $conexion = $pdo;
}

// 1. Limpiamos espacios para que Apache en Linux no rompa la URL
$nombre_limpio = str_replace(' ', '_', $_FILES['imagen']['name']);
$nombre = time() . "_" . $nombre_limpio;

// Ruta física para mover el archivo dentro del servidor
$ruta_fisica = "../uploads/" . $nombre;

// 2. Ruta limpia que se guardará en la BD (SIN el "../" para no confundir a JS)
$ruta_bd = "uploads/" . $nombre;

if (move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta_fisica)) {
    $usuario_id = $_POST['usuario_id'] ?? 1;

    try {
        // Guardamos la ruta limpia directamente
        $sql_m = "INSERT INTO imagenes (nombre, ruta, usuario_id) VALUES (?, ?, ?)";
        $stmt_m = $conexion->prepare($sql_m);
        
        if ($stmt_m->execute([$nombre, $ruta_bd, $usuario_id])) {
            echo "OK"; 
        } else {
            echo "Error en Postgres";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Error: El servidor no pudo guardar el archivo físico en uploads/.";
}
?>