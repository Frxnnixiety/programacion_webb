<?php
include("../config/conexion.php");
// Inicializar la conexión PDO
$conexion = conectarDB();

// Recibir datos del formulario (Asegúrate de que coincidan con tu JS)
$nombre = time() . "_" . $_FILES['imagen']['name'];
$ruta = "../uploads/" . $nombre;
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

$usuario_id = $_POST['usuario_id'] ?? 1;

try {
    // 1. INSERTAR EN MARIADB (Genera ID automático)
    $sql_m = "INSERT INTO imagenes (nombre, ruta, usuario_id) VALUES (?, ?, ?)";
    $stmt_m = $conexion->prepare($sql_m);
    
    // Ejecutamos pasando los parámetros directamente en un arreglo (Sintaxis PDO)
    if ($stmt_m->execute([$nombre, $ruta, $usuario_id])) {
        // 2. CAPTURAMOS EL ID QUE ACABA DE CREAR MARIADB (Sintaxis PDO)
        $nuevo_id = $conexion->lastInsertId();

        echo "OK"; // Respuesta para el AJAX
    } else {
        echo "Error en MariaDB";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>