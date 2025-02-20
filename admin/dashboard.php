<?php
session_start();

// Verificar si el usuario está logueado y es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
    $_SESSION['mensaje'] = "Acceso no autorizado";
    $_SESSION['mensaje_tipo'] = "error";
    header('Location: ../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrador - CESFAM</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Administración</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="usuarios.php"><i class="fas fa-users-cog"></i> Gestión Usuarios</a></li>
                    <li><a href="permisos.php"><i class="fas fa-user-lock"></i> Permisos</a></li>
                    <li><a href="profesionales.php"><i class="fas fa-user-md"></i> Profesionales</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-hospital-user"></i> Pacientes</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Agenda Global</a></li>
                    <li><a href="estadisticas.php"><i class="fas fa-chart-line"></i> Estadísticas</a></li>
                    <li><a href="reportes.php"><i class="fas fa-file-alt"></i> Reportes</a></li>
                    <li><a href="configuracion.php"><i class="fas fa-cogs"></i> Configuración</a></li>
                    <li><a href="respaldos.php"><i class="fas fa-database"></i> Respaldos</a></li>
                    <li><a href="auditoria.php"><i class="fas fa-clipboard-list"></i> Auditoría</a></li>
                    <li><a href="mantenimiento.php"><i class="fas fa-tools"></i> Mantenimiento</a></li>
                    <li><a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <h1>Bienvenido(a) Administrador <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($_SESSION['rut']); ?></span>
                    <a href="../logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Resumen del Sistema -->
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Usuarios Activos</h3>
                        <p class="number">0</p>
                        <p class="detail">Conectados ahora</p>
                    </div>
                    <div class="card">
                        <h3>Atenciones</h3>
                        <p class="number">0</p>
                        <p class="detail">Hoy</p>
                    </div>
                    <div class="card">
                        <h3>Incidencias</h3>
                        <p class="number">0</p>
                        <p class="detail">Sin resolver</p>
                    </div>
                    <div class="card">
                        <h3>Rendimiento</h3>
                        <p class="number">100%</p>
                        <p class="detail">Sistema</p>
                    </div>
                </div>

                <!-- Actividad del Sistema -->
                <div class="system-activity">
                    <h2>Actividad Reciente</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Usuario</th>
                                    <th>Acción</th>
                                    <th>Módulo</th>
                                    <th>Estado</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargará la actividad del sistema -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Estadísticas del Sistema -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Uso del Sistema</h3>
                        <canvas id="systemUsageChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Atenciones por Área</h3>
                        <canvas id="attentionsByAreaChart"></canvas>
                    </div>
                </div>

                <!-- Estado del Sistema -->
                <div class="system-status">
                    <h2>Estado del Sistema</h2>
                    <div class="status-grid">
                        <div class="status-card">
                            <h3>Recursos</h3>
                            <div class="resource-list">
                                <!-- Estado de recursos del sistema -->
                            </div>
                        </div>
                        <div class="status-card">
                            <h3>Servicios</h3>
                            <div class="service-list">
                                <!-- Estado de servicios del sistema -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Alertas del Sistema -->
                <div class="system-alerts">
                    <h2>Alertas del Sistema</h2>
                    <div class="alerts-grid">
                        <!-- Aquí se cargarán las alertas del sistema -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../js/dashboard-admin.js"></script>
</body>
</html> 