<?php
session_start();

// Verificar si el usuario está logueado y es trabajador social
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'trabajador_social') {
    $_SESSION['mensaje'] = "Acceso no autorizado";
    $_SESSION['mensaje_tipo'] = "error";
    header('Location: ../../index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Trabajo Social - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Trabajo Social</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="casos.php"><i class="fas fa-folder-open"></i> Casos</a></li>
                    <li><a href="visitas.php"><i class="fas fa-house-user"></i> Visitas Domiciliarias</a></li>
                    <li><a href="beneficios.php"><i class="fas fa-hand-holding-heart"></i> Beneficios Sociales</a></li>
                    <li><a href="evaluaciones.php"><i class="fas fa-clipboard-list"></i> Evaluaciones Sociales</a></li>
                    <li><a href="grupos.php"><i class="fas fa-users"></i> Grupos Comunitarios</a></li>
                    <li><a href="informes.php"><i class="fas fa-file-alt"></i> Informes Sociales</a></li>
                    <li><a href="derivaciones.php"><i class="fas fa-exchange-alt"></i> Derivaciones</a></li>
                    <li><a href="historial.php"><i class="fas fa-history"></i> Historial</a></li>
                    <li><a href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <h1>Bienvenido(a) <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($_SESSION['rut']); ?></span>
                    <a href="../../logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Resumen -->
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Casos Activos</h3>
                        <p class="number">0</p>
                        <p class="detail">En seguimiento</p>
                    </div>
                    <div class="card">
                        <h3>Visitas Hoy</h3>
                        <p class="number">0</p>
                        <p class="detail">Programadas</p>
                    </div>
                    <div class="card">
                        <h3>Evaluaciones</h3>
                        <p class="number">0</p>
                        <p class="detail">Pendientes</p>
                    </div>
                    <div class="card">
                        <h3>Informes</h3>
                        <p class="number">0</p>
                        <p class="detail">Por completar</p>
                    </div>
                </div>

                <!-- Casos Urgentes -->
                <div class="urgent-cases">
                    <h2>Casos Urgentes</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Prioridad</th>
                                    <th>Paciente</th>
                                    <th>RUT</th>
                                    <th>Situación</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargarán los casos urgentes dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Próximas Visitas -->
                <div class="upcoming-visits">
                    <h2>Próximas Visitas Domiciliarias</h2>
                    <div class="visits-grid">
                        <!-- Aquí se cargarán las visitas programadas -->
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Tipos de Casos</h3>
                        <canvas id="caseTypesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Beneficios Otorgados</h3>
                        <canvas id="benefitsChart"></canvas>
                    </div>
                </div>

                <!-- Actividades Comunitarias -->
                <div class="community-activities">
                    <h2>Actividades Comunitarias</h2>
                    <div class="activities-grid">
                        <!-- Aquí se cargarán las actividades dinámicamente -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-trabajador-social.js"></script>
</body>
</html> 