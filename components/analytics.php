<!-- Google Analytics 4 (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  // Reemplazar G-XXXXXXXXXX con tu ID de medición real de Google Analytics
  gtag('config', 'G-XXXXXXXXXX');
</script>

<!-- Código adicional para cookies y privacidad -->
<script>
  // Verificar si el usuario ha aceptado las cookies
  if (localStorage.getItem('cookies-accepted')) {
    // Activar analytics solo si el usuario ha aceptado
    gtag('consent', 'update', {
      'analytics_storage': 'granted'
    });
  } else {
    // Desactivar analytics si el usuario no ha aceptado
    gtag('consent', 'default', {
      'analytics_storage': 'denied'
    });
  }
</script>

<?php
// Variables de configuración para analytics
$analytics_config = [
    'enabled' => false, // Cambiar a true cuando esté en producción
    'debug_mode' => false,
    'tracking_id' => 'G-XXXXXXXXXX' // Reemplazar con tu ID real
];

// Función para verificar si estamos en ambiente de producción
function isProduction() {
    return $_SERVER['SERVER_NAME'] === 'cesfamsantodomingo.cl';
}

// Solo mostrar analytics en producción
if ($analytics_config['enabled'] && isProduction()) {
    // Aquí puedes agregar código adicional de seguimiento
    if ($analytics_config['debug_mode']) {
        error_log('Analytics cargado correctamente');
    }
}
?> 