<?php
include("../config/conexion.php");

// Obtenemos la conexión PDO llamando a la función del archivo conexion.php
$conexion = conectarDB();

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    try {
        // Preparar la sentencia usando el objeto PDO $conexion
        $sql_m = "DELETE FROM imagenes WHERE id = ?";
        $stmt_m = $conexion->prepare($sql_m);
        
        // En PDO, pasamos los parámetros directamente en el execute
        if ($stmt_m->execute([$id])) {
            echo "OK"; 
        }
    } catch (PDOException $e) {
        error_log("Error MariaDB: " . $e->getMessage());
        echo "Error al eliminar";
    }
}
?>