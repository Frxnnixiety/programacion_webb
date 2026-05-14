<?php
include("../config/conexion.php");
$conexion = conectarDB();

$sql = "SELECT * FROM imagenes ORDER BY id DESC";
$stmt = $conexion->query($sql);

// fetchAll con FETCH_ASSOC devuelve todo el array directamente
$imagenes = $stmt->fetchAll();

echo json_encode($imagenes);
?>