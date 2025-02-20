<?php
session_start();

// Verificar si el usuario está logueado y es terapeuta ocupacional
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'terapeuta_ocupacional') {
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
    <title>Dashboard Terapia Ocupacional - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Terapia Ocupacional</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-user-injured"></i> Pacientes</a></li>
                    <li><a href="evaluaciones.php"><i class="fas fa-clipboard-check"></i> Evaluaciones</a></li>
                    <li><a href="intervenciones.php"><i class="fas fa-hands-helping"></i> Intervenciones</a></li>
                    <li><a href="actividades.php"><i class="fas fa-tasks"></i> Actividades</a></li>
                    <li><a href="ayudas-tecnicas.php"><i class="fas fa-wheelchair"></i> Ayudas Técnicas</a></li>
                    <li><a href="talleres.php"><i class="fas fa-users"></i> Talleres Grupales</a></li>
                    <li><a href="informes.php"><i class="fas fa-file-alt"></i> Informes</a></li>
                    <li><a href="historial.php"><i class="fas fa-history"></i> Historial</a></li>
                    <li><a href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <h1>Bienvenido(a) T.O. <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($_SESSION['rut']); ?></span>
                    <a href="../../logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Resumen -->
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Pacientes Hoy</h3>
                        <p class="number">0</p>
                        <p class="detail">Próxima sesión: 09:00</p>
                    </div>
                    <div class="card">
                        <h3>Evaluaciones</h3>
                        <p class="number">0</p>
                        <p class="detail">Pendientes</p>
                    </div>
                    <div class="card">
                        <h3>Talleres</h3>
                        <p class="number">0</p>
                        <p class="detail">Esta semana</p>
                    </div>
                    <div class="card">
                        <h3>Ayudas Técnicas</h3>
                        <p class="number">0</p>
                        <p class="detail">En proceso</p>
                    </div>
                </div>

                <!-- Próximas Atenciones -->
                <div class="upcoming-appointments">
                    <h2>Próximas Atenciones</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>RUT</th>
                                    <th>Tipo Intervención</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargarán las atenciones dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Tipos de Intervención</h3>
                        <canvas id="interventionTypesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Progreso Pacientes</h3>
                        <canvas id="patientProgressChart"></canvas>
                    </div>
                </div>

                <!-- Talleres Grupales -->
                <div class="workshops-section">
                    <h2>Talleres Grupales</h2>
                    <div class="workshops-grid">
                        <!-- Aquí se cargarán los talleres dinámicamente -->
                    </div>
                </div>

                <!-- Ayudas Técnicas -->
                <div class="technical-aids">
                    <h2>Gestión de Ayudas Técnicas</h2>
                    <div class="aids-grid">
                        <div class="aid-card pending">
                            <h3>Solicitudes Pendientes</h3>
                            <div class="aid-list">
                                <!-- Lista de solicitudes pendientes -->
                            </div>
                        </div>
                        <div class="aid-card active">
                            <h3>En Seguimiento</h3>
                            <div class="aid-list">
                                <!-- Lista de ayudas técnicas en seguimiento -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-terapeuta.js"></script>
</body>
</html> 