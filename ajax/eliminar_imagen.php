<?php
include("../config/conexion.php");

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

if ($id > 0) {
    // Borrado en Postgres
    try {
        $pdo_postgres->exec("DELETE FROM imagenes WHERE id = $id");
    } catch (PDOException $e) {
        error_log("Error Postgres: " . $e->getMessage());
    }

    // Borrado en MariaDB
    $sql_m = "DELETE FROM imagenes WHERE id = ?";
    $stmt_m = $conexion->prepare($sql_m);
    $stmt_m->bind_param("i", $id);
    
    if ($stmt_m->execute()) {
        echo "OK"; 
    }
}
?>