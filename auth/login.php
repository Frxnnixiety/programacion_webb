<?php

session_start();

include("../config/conexion.php");

$correo = $_POST['correo'];

$password = $_POST['password'];

$sql = "SELECT * FROM usuarios WHERE correo=?";

$stmt = $conexion->prepare($sql);

$stmt->bind_param("s",$correo);

$stmt->execute();

$resultado = $stmt->get_result();

if($resultado->num_rows > 0){

    $usuario = $resultado->fetch_assoc();

    if(password_verify($password,$usuario['password'])){

        $_SESSION['usuario'] = $usuario['nombre'];

        $_SESSION['id_usuario'] = $usuario['id'];

        header("Location: ../dashboard.php");

    }else{

        echo "Contraseña incorrecta";

    }

}else{

    echo "Usuario no encontrado";

}

?>