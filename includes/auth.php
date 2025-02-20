<?php
// Iniciar sesión si no está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Función para verificar la autenticación
function verificarAutenticacion() {
    if (!isset($_SESSION['user_id'])) {
        error_log('No hay sesión de usuario activa');
        $_SESSION['mensaje'] = "Por favor, inicie sesión para continuar";
        $_SESSION['mensaje_tipo'] = "error";
        header('Location: ' . determinarRutaIndex());
        exit();
    }
}

// Función para verificar el tipo de usuario
function verificarTipoUsuario($tipo_requerido) {
    if ($_SESSION['tipo_usuario'] !== $tipo_requerido) {
        error_log('Tipo de usuario incorrecto: ' . $_SESSION['tipo_usuario'] . ' (requerido: ' . $tipo_requerido . ')');
        $_SESSION['mensaje'] = "No tiene permisos para acceder a esta área";
        $_SESSION['mensaje_tipo'] = "error";
        header('Location: ' . determinarRutaIndex());
        exit();
    }
}

// Función para determinar la ruta al index.php
function determinarRutaIndex() {
    $profundidad = substr_count($_SERVER['PHP_SELF'], '/');
    return str_repeat('../', $profundidad - 1) . 'index.php';
} 