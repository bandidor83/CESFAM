<?php
// Mostrar errores para diagnóstico
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verificar el estado de la sesión
$sessionStatus = session_status();
echo "<!-- Estado de la sesión: ";
switch($sessionStatus) {
    case PHP_SESSION_DISABLED:
        echo "Las sesiones están deshabilitadas";
        break;
    case PHP_SESSION_NONE:
        echo "Las sesiones están habilitadas pero ninguna existe";
        break;
    case PHP_SESSION_ACTIVE:
        echo "Las sesiones están habilitadas y una existe";
        break;
}
echo " -->";

// Iniciar sesión si no está activa
if ($sessionStatus == PHP_SESSION_NONE) {
    session_start();
}

// Verificar la ruta actual
echo "<!-- Ruta actual: " . $_SERVER['REQUEST_URI'] . " -->";
echo "<!-- Directorio actual: " . __DIR__ . " -->";
?>

<header>
    <div class="header-banner">
        <div class="banner-content">
            <img src="assets/images/logo.png" alt="CESFAM Logo">
            <h1>CESFAM Rocas de Santo Domingo</h1>
            <a href="/" class="nav-link">Inicio</a>
            <a href="/servicios.php" class="nav-link">Servicios</a>
            <a href="/contacto.php" class="nav-link">Contacto</a>
            <button id="openLoginModal" class="btn-login">Iniciar Sesión</button>
        </div>
    </div>
</header>

<!-- Modal de Login -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <div class="login-header">
            <img src="assets/images/logo.png" alt="CESFAM Logo" class="modal-logo">
            <h2>Acceso al Sistema</h2>
        </div>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="modal_rut">RUT:</label>
                <input type="text" id="modal_rut" name="rut" required autocomplete="username">
            </div>
            <div class="form-group">
                <label for="modal_password">Contraseña:</label>
                <input type="password" id="modal_password" name="password" required autocomplete="current-password">
            </div>
            <button type="submit" class="btn-submit">Ingresar al Sistema</button>
        </form>
    </div>
</div>

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

/* Botón de login */
.btn-login {
    background-color: #ffffff;
    color: #1a237e;
    padding: 0.7rem 1.8rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 1.1rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-login:hover {
    background-color: #e3f2fd;
    transform: translateY(-2px);
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

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.6);
    z-index: 1000;
}

.modal-content {
    position: relative;
    background-color: #fff;
    margin: 10% auto;
    padding: 20px;
    width: 90%;
    max-width: 400px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    color: #333333; /* Color oscuro para el texto del modal */
}

.login-header {
    text-align: center;
    margin-bottom: 20px;
}

.modal-logo {
    max-width: 120px;
    margin-bottom: 10px;
}

.close {
    position: absolute;
    right: 15px;
    top: 10px;
    font-size: 24px;
    font-weight: bold;
    color: #666;
    cursor: pointer;
}

.close:hover {
    color: #000;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #333333; /* Color oscuro para las etiquetas */
}

.form-group input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    color: #333333; /* Color oscuro para el texto de input */
}

.btn-submit {
    width: 100%;
    padding: 12px;
    background-color: #3498db;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    font-weight: bold;
}

.btn-submit:hover {
    background-color: #2980b9;
}
</style>

<?php
// Verificar si hay mensajes de error o éxito en la sesión
if (isset($_SESSION['mensaje'])) {
    echo '<div class="alert alert-' . ($_SESSION['mensaje_tipo'] ?? 'info') . '">';
    echo htmlspecialchars($_SESSION['mensaje']);
    echo '</div>';
    unset($_SESSION['mensaje']);
    unset($_SESSION['mensaje_tipo']);
}
?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Elementos del DOM
    const modal = document.getElementById('loginModal');
    const openBtn = document.getElementById('openLoginModal');
    const closeBtn = document.querySelector('.close');
    const loginForm = document.getElementById('modalLoginForm');
    const rutInput = document.getElementById('modal_login_rut');

    // Función para formatear RUT (solo guión, sin puntos)
    function formatRut(value) {
        // Eliminar todos los caracteres no deseados
        value = value.replace(/[^\dkK]/g, '');
        
        // Si hay suficientes caracteres, agregar el guión
        if (value.length > 1) {
            value = value.slice(0, -1) + '-' + value.slice(-1);
        }
        
        return value;
    }

    // Abrir modal
    if (openBtn) {
        openBtn.addEventListener('click', function() {
            modal.style.display = "block";
        });
    }

    // Cerrar modal
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            modal.style.display = "none";
        });
    }

    // Cerrar al hacer clic fuera del modal
    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });

    // Formatear RUT mientras se escribe
    if (rutInput) {
        rutInput.addEventListener('input', function(e) {
            e.target.value = formatRut(e.target.value);
        });
    }

    // Validar formulario antes de enviar
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            const rut = rutInput.value.trim();
            if (!rut) {
                e.preventDefault();
                alert('Por favor, ingrese su RUT');
                return false;
            }

            // Verificar formato del RUT
            const rutFormateado = formatRut(rut);
            if (rutFormateado !== rut) {
                e.preventDefault();
                rutInput.value = rutFormateado;
                alert('El formato del RUT ha sido corregido. Por favor, verifique y envíe nuevamente.');
                return false;
            }
        });
    }
});
</script> 