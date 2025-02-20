<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rut = trim($_POST['rut'] ?? '');
    $password = $_POST['password'] ?? '';

    try {
        $sql = "SELECT * FROM usuarios WHERE rut = :rut";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':rut' => $rut]);
        
        if ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (password_verify($password, $user['password'])) {
                // Establecer variables de sesión
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['rut'] = $user['rut'];
                $_SESSION['nombre'] = $user['nombre'];
                $_SESSION['apellido'] = $user['apellido'];
                $_SESSION['tipo_usuario'] = $user['tipo_usuario'];

                // Redirección directa según el tipo de usuario
                switch ($user['tipo_usuario']) {
                    case 'administrativo_some':
                        header("Location: profesiones/administrativo_some/dashboard.php");
                        exit();
                    case 'medico':
                        header("Location: profesiones/medico/dashboard.php");
                        exit();
                    default:
                        $_SESSION['mensaje'] = "Tipo de usuario no válido";
                        $_SESSION['mensaje_tipo'] = "error";
                        header("Location: index.php");
                        exit();
                }
            } else {
                $_SESSION['mensaje'] = "Contraseña incorrecta";
                $_SESSION['mensaje_tipo'] = "error";
            }
        } else {
            $_SESSION['mensaje'] = "Usuario no encontrado";
            $_SESSION['mensaje_tipo'] = "error";
        }
    } catch(PDOException $e) {
        error_log("Error en login: " . $e->getMessage());
        $_SESSION['mensaje'] = "Error del sistema";
        $_SESSION['mensaje_tipo'] = "error";
    }
}

// Si llegamos aquí, hubo un error
header("Location: index.php");
exit();
?>