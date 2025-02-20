<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CESFAM Santo Domingo</title>
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="css/modal.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- Header con el modal de login -->
    <?php include 'components/header.php'; ?>

    <!-- Contenido principal -->
    <main>
        <?php 
        // Mostrar mensajes de sesión si existen
        if (isset($_SESSION['mensaje'])) {
            echo "<div class='alert alert-{$_SESSION['mensaje_tipo']}'>";
            echo $_SESSION['mensaje'];
            echo "</div>";
            unset($_SESSION['mensaje']);
            unset($_SESSION['mensaje_tipo']);
        }
        ?>
        
        <!-- Contenido principal de la página -->
        <?php include 'components/main-content.php'; ?>
    </main>

    <!-- Footer -->
    <?php include 'components/footer.php'; ?>

    <!-- Scripts -->
    <script src="js/modal.js"></script>
</body>
</html> 