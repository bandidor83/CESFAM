<?php
session_start();

// Destruir todas las variables de sesión
$_SESSION = array();

// Destruir la cookie de sesión si existe
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destruir la sesión
session_destroy();

// Iniciar nueva sesión para mensaje
session_start();
$_SESSION['mensaje'] = "Has cerrado sesión correctamente";
$_SESSION['mensaje_tipo'] = "success";

// Redirigir al index
header('Location: index.php');
exit();
?>