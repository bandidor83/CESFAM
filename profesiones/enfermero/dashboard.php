<?php
session_start();

// Verificar si el usuario está logueado y es enfermero
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'enfermero') {
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
    <title>Dashboard Enfermería - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Enfermería</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-user-injured"></i> Pacientes</a></li>
                    <li><a href="controles.php"><i class="fas fa-heartbeat"></i> Controles</a></li>
                    <li><a href="vacunacion.php"><i class="fas fa-syringe"></i> Vacunación</a></li>
                    <li><a href="curaciones.php"><i class="fas fa-band-aid"></i> Curaciones</a></li>
                    <li><a href="procedimientos.php"><i class="fas fa-procedures"></i> Procedimientos</a></li>
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
                        <h3>Atenciones Hoy</h3>
                        <p class="number">0</p>
                        <p class="detail">Próxima: 09:00</p>
                    </div>
                    <div class="card">
                        <h3>Curaciones</h3>
                        <p class="number">0</p>
                        <p class="detail">Pendientes hoy</p>
                    </div>
                    <div class="card">
                        <h3>Vacunas</h3>
                        <p class="number">0</p>
                        <p class="detail">Aplicadas hoy</p>
                    </div>
                    <div class="card">
                        <h3>Controles</h3>
                        <p class="number">0</p>
                        <p class="detail">Programados</p>
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

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Atenciones por Tipo</h3>
                        <canvas id="attentionTypesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Vacunación Diaria</h3>
                        <canvas id="vaccinationChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-enfermero.js"></script>
</body>
</html> 