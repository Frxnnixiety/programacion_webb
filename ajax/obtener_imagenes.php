<?php
include("../config/conexion.php");
$conexion = conectarDB();

try {
    $sql = "SELECT id, nombre, ruta FROM imagenes ORDER BY id DESC";
    $stmt = $conexion->query($sql);
    $imagenes = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($imagenes);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>