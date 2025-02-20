<?php
session_start();

// Verificar si el usuario está logueado y es TENS
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'tens') {
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
    <title>Dashboard TENS - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>TENS</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="agenda.php"><i class="fas fa-calendar-alt"></i> Mi Agenda</a></li>
                    <li><a href="pacientes.php"><i class="fas fa-user-injured"></i> Pacientes</a></li>
                    <li><a href="signos-vitales.php"><i class="fas fa-heartbeat"></i> Signos Vitales</a></li>
                    <li><a href="curaciones.php"><i class="fas fa-band-aid"></i> Curaciones</a></li>
                    <li><a href="procedimientos.php"><i class="fas fa-procedures"></i> Procedimientos</a></li>
                    <li><a href="vacunacion.php"><i class="fas fa-syringe"></i> Vacunación</a></li>
                    <li><a href="medicamentos.php"><i class="fas fa-pills"></i> Medicamentos</a></li>
                    <li><a href="insumos.php"><i class="fas fa-first-aid"></i> Control Insumos</a></li>
                    <li><a href="esterilizacion.php"><i class="fas fa-pump-medical"></i> Esterilización</a></li>
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
                        <p class="detail">Pendientes</p>
                    </div>
                    <div class="card">
                        <h3>Vacunas</h3>
                        <p class="number">0</p>
                        <p class="detail">Aplicadas hoy</p>
                    </div>
                    <div class="card">
                        <h3>Procedimientos</h3>
                        <p class="number">0</p>
                        <p class="detail">En espera</p>
                    </div>
                </div>

                <!-- Lista de Espera -->
                <div class="waiting-list">
                    <h2>Lista de Espera</h2>
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
                                <!-- Aquí se cargarán los pacientes en espera -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Control de Insumos -->
                <div class="supplies-section">
                    <h2>Control de Insumos</h2>
                    <div class="supplies-grid">
                        <div class="supply-card critical">
                            <h3>Stock Crítico</h3>
                            <div class="supply-list">
                                <!-- Lista de insumos críticos -->
                            </div>
                        </div>
                        <div class="supply-card expiring">
                            <h3>Por Vencer</h3>
                            <div class="supply-list">
                                <!-- Lista de insumos por vencer -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Procedimientos Realizados</h3>
                        <canvas id="proceduresChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Vacunación Diaria</h3>
                        <canvas id="vaccinationChart"></canvas>
                    </div>
                </div>

                <!-- Esterilización -->
                <div class="sterilization-section">
                    <h2>Control de Esterilización</h2>
                    <div class="sterilization-grid">
                        <!-- Aquí se cargará el estado de esterilización -->
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-tens.js"></script>
</body>
</html> 