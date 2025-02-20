<?php
// Configuración de la base de datos
define('DB_HOST', 'localhost');
define('DB_USER', 'root');         // Cambia esto por tu usuario de MySQL
define('DB_PASS', '');             // Cambia esto por tu contraseña de MySQL
define('DB_NAME', 'cesfam_db');    // Nombre de la base de datos

// Intentar conectar a la base de datos
try {
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
        DB_USER,
        DB_PASS
    );
    
    // Configurar el modo de error de PDO para que lance excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar el modo de obtención predeterminado
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    // En producción, deberías manejar esto de manera más segura
    die("Error de conexión: " . $e->getMessage());
}

// También necesitaremos crear la tabla de usuarios si no existe
$sql = "CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    rut VARCHAR(12) NOT NULL UNIQUE,
    profesion VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    activo BOOLEAN DEFAULT FALSE,
    token_confirmacion VARCHAR(100)
)";

try {
    $conn->exec($sql);
} catch(PDOException $e) {
    die("Error creando la tabla: " . $e->getMessage());
}
?> 