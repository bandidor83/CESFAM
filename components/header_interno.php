<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<header>
    <div class="header-banner">
        <div class="banner-content">
            <img src="../../assets/images/logo.png" alt="CESFAM Logo">
            <h1>CESFAM Rocas de Santo Domingo</h1>
            <a href="/" class="nav-link">Inicio</a>
            <a href="/servicios.php" class="nav-link">Servicios</a>
            <a href="/contacto.php" class="nav-link">Contacto</a>
            <span class="user-welcome">Bienvenido/a, <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></span>
            <a href="../../logout.php" class="btn-logout">Cerrar Sesión</a>
        </div>
    </div>
</header>

<style>
/* Estilos del banner */
.header-banner {
    background-color: #1a237e;
    padding: 1rem;
    width: 100%;
}

.banner-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo-title {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.logo-title img {
    height: 80px;
    width: auto;
}

.logo-title h1 {
    color: #ffffff;
    font-size: 2rem;
    font-weight: bold;
    margin: 0;
}

/* Menú de navegación */
.nav-menu ul {
    display: flex;
    list-style: none;
    margin: 0;
    padding: 0;
    gap: 2rem;
}

.nav-menu ul li a {
    color: #ffffff;
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.nav-menu ul li a:hover {
    color: #64b5f6;
}

/* Estilos responsivos */
@media (max-width: 1024px) {
    .banner-content {
        padding: 0 1rem;
    }
    
    .logo-title h1 {
        font-size: 1.5rem;
    }
}

@media (max-width: 768px) {
    .banner-content {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .nav-menu ul {
        flex-wrap: wrap;
        justify-content: center;
    }
}
</style> 