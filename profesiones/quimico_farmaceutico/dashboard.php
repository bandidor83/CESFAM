<?php
session_start();

// Verificar si el usuario está logueado y es químico farmacéutico
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'quimico_farmaceutico') {
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
    <title>Dashboard Farmacia - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="../../css/dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="dashboard">
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Farmacia</h2>
                <p>Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="dashboard.php" class="active"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="inventario.php"><i class="fas fa-boxes"></i> Inventario</a></li>
                    <li><a href="dispensacion.php"><i class="fas fa-pills"></i> Dispensación</a></li>
                    <li><a href="recetas.php"><i class="fas fa-prescription"></i> Recetas</a></li>
                    <li><a href="pedidos.php"><i class="fas fa-shopping-cart"></i> Pedidos</a></li>
                    <li><a href="proveedores.php"><i class="fas fa-truck"></i> Proveedores</a></li>
                    <li><a href="vencimientos.php"><i class="fas fa-calendar-times"></i> Control Vencimientos</a></li>
                    <li><a href="controlados.php"><i class="fas fa-lock"></i> Medicamentos Controlados</a></li>
                    <li><a href="reportes.php"><i class="fas fa-chart-bar"></i> Reportes</a></li>
                    <li><a href="alertas.php"><i class="fas fa-exclamation-triangle"></i> Alertas</a></li>
                    <li><a href="historial.php"><i class="fas fa-history"></i> Historial</a></li>
                    <li><a href="../../logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Contenido principal -->
        <main class="dashboard-main">
            <header class="dashboard-header">
                <h1>Bienvenido(a) Q.F. <?php echo htmlspecialchars($_SESSION['nombre'] . ' ' . $_SESSION['apellido']); ?></h1>
                <div class="user-info">
                    <span><?php echo htmlspecialchars($_SESSION['rut']); ?></span>
                    <a href="../../logout.php" class="btn-logout">Cerrar Sesión</a>
                </div>
            </header>

            <div class="dashboard-content">
                <!-- Resumen -->
                <div class="dashboard-cards">
                    <div class="card">
                        <h3>Recetas Pendientes</h3>
                        <p class="number">0</p>
                        <p class="detail">Por dispensar</p>
                    </div>
                    <div class="card">
                        <h3>Stock Crítico</h3>
                        <p class="number">0</p>
                        <p class="detail">Medicamentos</p>
                    </div>
                    <div class="card">
                        <h3>Por Vencer</h3>
                        <p class="number">0</p>
                        <p class="detail">Próximos 30 días</p>
                    </div>
                    <div class="card">
                        <h3>Pedidos</h3>
                        <p class="number">0</p>
                        <p class="detail">En proceso</p>
                    </div>
                </div>

                <!-- Alertas Importantes -->
                <div class="alerts-section">
                    <h2>Alertas Importantes</h2>
                    <div class="alerts-grid">
                        <!-- Aquí se cargarán las alertas dinámicamente -->
                    </div>
                </div>

                <!-- Dispensación Pendiente -->
                <div class="pending-prescriptions">
                    <h2>Dispensación Pendiente</h2>
                    <div class="table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hora</th>
                                    <th>Paciente</th>
                                    <th>RUT</th>
                                    <th>Medicamento</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí se cargarán las dispensaciones pendientes -->
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="statistics-section">
                    <div class="chart-container">
                        <h3>Dispensación Diaria</h3>
                        <canvas id="dispensationChart"></canvas>
                    </div>
                    <div class="chart-container">
                        <h3>Stock por Categoría</h3>
                        <canvas id="stockChart"></canvas>
                    </div>
                </div>

                <!-- Control de Medicamentos -->
                <div class="medication-control">
                    <h2>Control de Medicamentos</h2>
                    <div class="control-grid">
                        <div class="control-card expiring">
                            <h3>Próximos a Vencer</h3>
                            <div class="medication-list">
                                <!-- Lista de medicamentos próximos a vencer -->
                            </div>
                        </div>
                        <div class="control-card controlled">
                            <h3>Controlados</h3>
                            <div class="medication-list">
                                <!-- Lista de medicamentos controlados -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../js/dashboard-farmacia.js"></script>
</body>
</html> 