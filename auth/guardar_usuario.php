<?php
include("../config/conexion.php");

if (!isset($conexion) && isset($pdo)) {
    $conexion = $pdo;
}

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// 1. Verificamos si el correo ya existe
$sqlVerificar = "SELECT id FROM usuarios WHERE correo = ?";
$stmtVerificar = $conexion->prepare($sqlVerificar);
$stmtVerificar->execute([$correo]);

if($stmtVerificar->rowCount() > 0){
    echo "El correo ya existe";
} else {
    // 2. Insertamos en Postgres
    try {
        $sql = "INSERT INTO usuarios(nombre, correo, password) VALUES(?, ?, ?)";
        $stmt = $conexion->prepare($sql);

        if($stmt->execute([$nombre, $correo, $passwordHash])){
            header("Location: ../index.php");
        } else {
            echo "Error al registrar";
        }
    } catch (PDOException $e) {
        echo "Error de base de datos: " . $e->getMessage();
    }
}
?>