<?php
session_start();
include("../config/conexion.php");
$conexion = conectarDB();

$correo = $_POST['correo'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo = ?";
$stmt = $conexion->prepare($sql);
$stmt->execute([$correo]);

// Obtenemos el usuario
$usuario = $stmt->fetch();

if($usuario){
    if(password_verify($password, $usuario['password'])){
        $_SESSION['usuario'] = $usuario['nombre'];
        $_SESSION['id_usuario'] = $usuario['id'];
        header("Location: ../dashboard.php");
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>