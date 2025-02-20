<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug
error_log("Dashboard - Sesión actual: " . print_r($_SESSION, true));

// Verificar autenticación
if (!isset($_SESSION['user_id']) || !isset($_SESSION['tipo_usuario'])) {
    error_log("No hay sesión activa");
    $_SESSION['mensaje'] = "Por favor inicie sesión";
    $_SESSION['mensaje_tipo'] = "error";
    header('Location: ../../index.php');
    exit();
}

// Verificar tipo de usuario
if ($_SESSION['tipo_usuario'] !== 'administrativo_some') {
    error_log("Tipo de usuario incorrecto: " . $_SESSION['tipo_usuario']);
    $_SESSION['mensaje'] = "Acceso no autorizado";
    $_SESSION['mensaje_tipo'] = "error";
    header('Location: ../../index.php');
    exit();
}

// Eliminar flag de login si existe
unset($_SESSION['login_success']);

// Si llegamos aquí, el usuario está autenticado y es del tipo correcto
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard SOME - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <header class="header-interno">
        <div class="header-banner">
            <div class="banner-content">
                <div class="logo-title">
                    <img src="../../assets/images/logo.png" alt="CESFAM Logo">
                    <h1>CESFAM Rocas de Santo Domingo</h1>
                </div>
                <div class="user-info">
                    <span>Bienvenido/a, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></span>
                    <a href="../../logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </header>

    <div class="dashboard-container">
        <h1>Dashboard SOME</h1>
        <?php include 'agenda.php'; ?>
    </div>

    <?php include '../../components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script>
</body>
</html> 