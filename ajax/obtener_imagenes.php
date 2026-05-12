<?php

include("../config/conexion.php");

$sql = "SELECT * FROM imagenes ORDER BY id DESC";

$resultado = $conexion->query($sql);

$imagenes = [];

while($fila = $resultado->fetch_assoc()){

    $imagenes[] = $fila;

}

echo json_encode($imagenes);

?>