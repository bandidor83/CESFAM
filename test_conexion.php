<?php
require_once 'config/database.php';

try {
    // Si llegamos aquí sin errores, significa que la conexión fue exitosa
    echo "¡Conexión exitosa a la base de datos!<br>";
    
    // Probar que podemos realizar consultas
    $query = "SELECT VERSION()";
    $stmt = $conn->query($query);
    $version = $stmt->fetch();
    
    echo "Versión de MySQL: " . $version['VERSION()'] . "<br>";
    
    // Verificar si la tabla usuarios existe
    $query = "SHOW TABLES LIKE 'usuarios'";
    $stmt = $conn->query($query);
    
    if ($stmt->rowCount() > 0) {
        echo "La tabla 'usuarios' existe.<br>";
        
        // Contar el número de usuarios
        $query = "SELECT COUNT(*) as total FROM usuarios";
        $stmt = $conn->query($query);
        $result = $stmt->fetch();
        echo "Número total de usuarios registrados: " . $result['total'];
    } else {
        echo "¡Advertencia! La tabla 'usuarios' no existe.";
    }
    
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?> 