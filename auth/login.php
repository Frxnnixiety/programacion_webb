<?php
session_start();

// 1. Forzamos a PHP a mostrar errores en pantalla por si falta algo más
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../config/conexion.php");

// 2. Quitamos "conectarDB()" porque en Postgres la conexión se activa directo en $conexion
// Si en tu conexion.php guardaste la variable como $pdo, usamos esa:
if (!isset($conexion) && isset($pdo)) {
    $conexion = $pdo;
}

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$correo]);

// Obtenemos el usuario
$usuario = $stmt->fetch();

if($usuario){
    // NOTA: Como insertamos al admin con la contraseña en texto plano ('admin123'),
    // añadimos esta validación temporal para que te deje entrar con 'admin123' 
    // o con contraseñas cifradas en un futuro.
    if(password_verify($password, $usuario['password']) || $password === $usuario['password']){
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['id_usuario'] = $usuario['id'];
        header("Location: ../dashboard.php");
        exit(); // Buena práctica para detener el script después de redireccionar
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>