<?php

include("../config/conexion.php");
// Inicializar la conexión PDO
$conexion = conectarDB();

$sql = "SELECT * FROM imagenes ORDER BY id DESC";

// Ejecutamos la consulta
$resultado = $conexion->query($sql);

$imagenes = [];

while($fila = $resultado->fetch()){

    // SOLUCIÓN: Limpiamos el "../" inicial para que la ruta sea relativa correcta en Linux
    // Si la ruta es "../uploads/imagen.png", pasará a ser "uploads/imagen.png"
    if (substr($fila['ruta'], 0, 3) === '../') {
        $fila['ruta'] = substr($fila['ruta'], 3);
    }

    $imagenes[] = $fila;
}

echo json_encode($imagenes);

?>