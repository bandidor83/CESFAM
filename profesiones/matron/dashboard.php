<?php
session_start();

// Verificar si el usuario está logueado y es matrón/matrona
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'matron') {
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
    <title>Dashboard Matronería - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Matronería</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-female"></i> Pacientes</a></li>
                    <li><a href="controles.php"><i class="fas fa-stethoscope"></i> Controles</a></li>
                    <li><a href="embarazadas.php"><i class="fas fa-baby-carriage"></i> Control Prenatal</a></li>
                    <li><a href="planificacion.php"><i class="fas fa-pills"></i> Planificación Familiar</a></li>
                    <li><a href="examenes.php"><i class="fas fa-microscope"></i> Exámenes</a></li>
                    <li><a href="educacion.php"><i class="fas fa-chalkboard-teacher"></i> Educación</a></li>
                    <li><a href="cancer.php"><i class="fas fa-ribbon"></i> Programa Cáncer</a></li>
                    <li><a href="its.php"><i class="fas fa-virus"></i> Control ITS</a></li>
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
                        <h3>Consultas Hoy</h3>
                        <p class="number">0</p>
                        <p class="detail">Próxima: 09:00</p>
                    </div>
                    <div class="card">
                        <h3>Embarazadas</h3>
                        <p class="number">0</p>
                        <p class="detail">Control activo</p>
                    </div>
                    <div class="card">
                        <h3>PAP Pendientes</h3>
                        <p class="number">0</p>
                        <p class="detail">Por realizar</p>
                    </div>
                    <div class="card">
                        <h3>Talleres</h3>
                        <p class="number">0</p>
                        <p class="detail">Esta semana</p>
                    </div>
                </div>

                <!-- Próximas atenciones -->
                <div class="upcoming-appointments">
                    <h2>Próximas Atenciones</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>RUT</th>
                                    <th>Tipo Atención</th>
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

                <!-- Control Prenatal -->
                <div class="prenatal-section">
                    <h2>Control Prenatal</h2>
                    <div class="prenatal-grid">
                        <!-- Aquí se cargarán los controles prenatales -->
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Tipos de Atención</h3>
                        <canvas id="attentionTypesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Cobertura PAP</h3>
                        <canvas id="papCoverageChart"></canvas>
                    </div>
                </div>

                <!-- Próximos Talleres -->
                <div class="workshops-section">
                    <h2>Próximos Talleres</h2>
                    <div class="workshops-grid">
                        <!-- Aquí se cargarán los talleres dinámicamente -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-matron.js"></script>
</body>
</html> 