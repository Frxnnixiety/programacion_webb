<?php
include("../config/conexion.php");
$conexion = conectarDB();

$sql = "SELECT * FROM imagenes ORDER BY id DESC";
$resultado = $conexion->query($sql);

$imagenes = [];
while($fila = $resultado->fetch()){
    // Reemplaza los "../" iniciales para que la ruta sea relativa a la raíz del sitio
    $fila['ruta'] = str_replace("../", "", $fila['ruta']);
    $imagenes[] = $fila;
}

echo json_encode($imagenes);
?>