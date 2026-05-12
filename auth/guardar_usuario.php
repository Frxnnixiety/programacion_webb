<?php

include("../config/conexion.php");

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];
$passwordHash = password_hash($password, PASSWORD_DEFAULT);

// 1. Verificamos si el correo ya existe (en MariaDB)
$sqlVerificar = "SELECT * FROM usuarios WHERE correo=?";
$stmtVerificar = $conexion->prepare($sqlVerificar);
$stmtVerificar->bind_param("s", $correo);
$stmtVerificar->execute();
$resultado = $stmtVerificar->get_result();

if($resultado->num_rows > 0){
    echo "El correo ya existe";
} else {
    // 2. Insertamos en MariaDB
    $sql = "INSERT INTO usuarios(nombre, correo, password) VALUES(?,?,?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $correo, $passwordHash);

    if($stmt->execute()){
        // --- INICIO DE SINCRONIZACIÓN CON POSTGRESQL ---
        
        // Obtenemos el ID que acaba de generar MariaDB para que sea el mismo en Postgres
        $nuevo_id = $conexion->insert_id;

        try {
            // Insertamos en Postgres usando el mismo ID, nombre, correo y hash
            $sql_p = "INSERT INTO usuarios (id, nombre, correo, password) VALUES (:id, :nom, :correo, :pass)";
            $stmt_p = $pdo_postgres->prepare($sql_p);
            $stmt_p->execute([
                ':id'     => $nuevo_id,
                ':nom'    => $nombre,
                ':correo' => $correo,
                ':pass'   => $passwordHash
            ]);

            // Actualizamos la secuencia de IDs en Postgres para evitar conflictos en el futuro
            $pdo_postgres->query("SELECT setval('usuarios_id_seq', (SELECT MAX(id) FROM usuarios))");

        } catch (PDOException $e) {
            // Si falla Postgres, lo registramos en el log para no interrumpir al usuario
            error_log("Error al sincronizar usuario en Postgres: " . $e->getMessage());
        }

        // --- FIN DE SINCRONIZACIÓN ---

        header("Location: ../index.php");
    } else {
        echo "Error al registrar";
    }
}

?>