<?php
include("../config/conexion.php");

// 1. Inicializamos la conexión usando la función definida en conexion.php
$conexion = conectarDB();

// Recibir datos del formulario
$nombre = time() . "_" . $_FILES['imagen']['name'];
$ruta = "../uploads/" . $nombre;
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

// El usuario_id suele venir del $_SESSION en aplicaciones reales, 
// pero mantenemos tu lógica de $_POST para consistencia.
$usuario_id = $_POST['usuario_id'] ?? 1;

try {
    // 2. Preparar la sentencia (PDO no requiere definir tipos como "ssi")
    $sql_m = "INSERT INTO imagenes (nombre, ruta, usuario_id) VALUES (?, ?, ?)";
    $stmt_m = $conexion->prepare($sql_m);
    
    // 3. Ejecutar pasando los valores en un array
    if ($stmt_m->execute([$nombre, $ruta, $usuario_id])) {
        echo "OK"; 
    } else {
        echo "Error en MariaDB";
    }
} catch (PDOException $e) {
    // Es buena práctica registrar el error exacto en el log del servidor
    error_log("Error en subida: " . $e->getMessage());
    echo "Error interno del servidor";
}
?>