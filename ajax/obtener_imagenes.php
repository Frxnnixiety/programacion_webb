<?php

include("../config/conexion.php");
// Inicializar la conexión PDO
$conexion = conectarDB();

$sql = "SELECT * FROM imagenes ORDER BY id DESC";

// En PDO, query() devuelve un objeto PDOStatement directamente ejecutable
$resultado = $conexion->query($sql);

$imagenes = [];

// fetch() con el modo por defecto (FETCH_ASSOC) configurado en tu conexión
while($fila = $resultado->fetch()){

    $imagenes[] = $fila;

}

echo json_encode($imagenes);

?>