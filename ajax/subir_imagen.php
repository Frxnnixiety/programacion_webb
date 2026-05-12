<?php
include("../config/conexion.php");

// Recibir datos del formulario (Asegúrate de que coincidan con tu JS)
$nombre = time() . "_" . $_FILES['imagen']['name'];
$ruta = "../uploads/" . $nombre;
move_uploaded_file($_FILES['imagen']['tmp_name'], $ruta);

$usuario_id = $_POST['usuario_id'] ?? 1;

// 1. INSERTAR EN MARIADB (Genera ID automático)
$sql_m = "INSERT INTO imagenes (nombre, ruta, usuario_id) VALUES (?, ?, ?)";
$stmt_m = $conexion->prepare($sql_m);
$stmt_m->bind_param("ssi", $nombre, $ruta, $usuario_id);

if ($stmt_m->execute()) {
    // 2. CAPTURAMOS EL ID QUE ACABA DE CREAR MARIADB
    $nuevo_id = $conexion->insert_id;

    // 3. INSERTAR EN POSTGRESQL FORZANDO ESE MISMO ID
    try {
        $sql_p = "INSERT INTO imagenes (id, nombre, ruta, usuario_id) VALUES (:id, :nom, :ruta, :uid)";
        $stmt_p = $pdo_postgres->prepare($sql_p);
        $stmt_p->execute([
            ':id'   => $nuevo_id,
            ':nom'  => $nombre,
            ':ruta' => $ruta,
            ':uid'  => $usuario_id
        ]);
        
        echo "OK"; // Respuesta para el AJAX
    } catch (PDOException $e) {
        echo "Error en Postgres: " . $e->getMessage();
    }
} else {
    echo "Error en MariaDB";
}
?>