<?php
include("../config/conexion.php");

// En Postgres la conexión se activa directo en $conexion o $pdo
if (!isset($conexion) && isset($pdo)) {
    $conexion = $pdo;
}

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
        error_log("Error Postgres: " . $e->getMessage());
        echo "Error al eliminar";
    }
}
?>