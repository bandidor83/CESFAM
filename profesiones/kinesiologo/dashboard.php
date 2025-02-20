<?php
session_start();

// Verificar si el usuario está logueado y es kinesiólogo
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'kinesiologo') {
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
    <title>Dashboard Kinesiología - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Kinesiología</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-user-injured"></i> Pacientes</a></li>
                    <li><a href="evaluaciones.php"><i class="fas fa-clipboard-check"></i> Evaluaciones</a></li>
                    <li><a href="tratamientos.php"><i class="fas fa-hand-holding-medical"></i> Tratamientos</a></li>
                    <li><a href="ejercicios.php"><i class="fas fa-running"></i> Ejercicios</a></li>
                    <li><a href="sala-rehabilitacion.php"><i class="fas fa-dumbbell"></i> Sala Rehabilitación</a></li>
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
                        <h3>Tratamientos</h3>
                        <p class="number">0</p>
                        <p class="detail">En curso</p>
                    </div>
                    <div class="card">
                        <h3>Sala Rehab</h3>
                        <p class="number">0</p>
                        <p class="detail">Cupos disponibles</p>
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
                                    <th>Tipo Sesión</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargarán las sesiones dinámicamente -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Tipos de Tratamiento</h3>
                        <canvas id="treatmentTypesChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Evolución Pacientes</h3>
                        <canvas id="patientProgressChart"></canvas>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-kinesiologo.js"></script>
</body>
</html> 