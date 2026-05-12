<?php
// Incluimos tu archivo de conexión corregido
require_once "config/conexion.php";

echo "<h2>Estado de las Conexiones</h2>";

// 1. Verificar MariaDB
if (isset($conexion) && !$conexion->connect_error) {
    echo "<p style='color: green;'>✅ MariaDB: Conexión establecida correctamente.</p>";
} else {
    echo "<p style='color: red;'>❌ MariaDB: Error en la conexión.</p>";
}

// 2. Verificar PostgreSQL
if (isset($pdo_postgres)) {
    try {
        // Intentamos una consulta simple
        $query = $pdo_postgres->query("SELECT version()");
        $row = $query->fetch();
        echo "<p style='color: green;'>✅ PostgreSQL: Conexión establecida correctamente.</p>";
        echo "<p>Versión detectada: " . $row[0] . "</p>";
    } catch (PDOException $e) {
        echo "<p style='color: red;'>❌ PostgreSQL: Error al consultar la base de datos: " . $e->getMessage() . "</p>";
    }
} else {
    echo "<p style='color: red;'>❌ PostgreSQL: La variable de conexión no existe o no se cargó el driver.</p>";
}
?>