<?php
session_start();
require_once '../../config/database.php';

// Verificar si el usuario está logueado y es administrativo
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'administrativo') {
    header('Location: ../../login.php');
    exit();
}

// Obtener la fecha actual
$fecha_actual = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda SOME - CESFAM</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>
<body>
    <?php include '../../components/header_interno.php'; ?>

    <main class="agenda-container">
        <div class="agenda-header">
            <h2>Agenda de Atención</h2>
            <div class="agenda-controls">
                <input type="text" id="fecha-agenda" class="flatpickr" placeholder="Seleccione una fecha">
                <select id="especialidad" class="form-control">
                    <option value="">Seleccione Especialidad</option>
                    <option value="medicina-general">Medicina General</option>
                    <option value="pediatria">Pediatría</option>
                    <option value="ginecologia">Ginecología</option>
                    <!-- Agregar más especialidades según necesidad -->
                </select>
                <select id="profesional" class="form-control">
                    <option value="">Seleccione Profesional</option>
                    <!-- Se llenará dinámicamente según la especialidad -->
                </select>
            </div>
        </div>

        <div class="horarios-disponibles">
            <!-- Aquí se mostrarán los horarios disponibles -->
        </div>
    </main>

    <style>
    .agenda-container {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .agenda-header {
        margin-bottom: 20px;
    }

    .agenda-controls {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .form-control {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
    }

    .horarios-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
        gap: 10px;
        margin-top: 20px;
    }

    .btn-horario {
        padding: 10px;
        background: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-horario:hover {
        background: #e0e0e0;
    }

    .no-horarios {
        text-align: center;
        color: #666;
        margin-top: 20px;
    }

    /* Estilos para Flatpickr */
    .flatpickr-calendar {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.2);
    }

    .flatpickr-day.selected {
        background: #1a237e;
        border-color: #1a237e;
    }

    .flatpickr-day.today {
        border-color: #1a237e;
    }

    .flatpickr-day.disabled {
        color: #ccc;
    }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configuración del calendario
        const fechaAgenda = flatpickr("#fecha-agenda", {
            locale: 'es',
            dateFormat: "Y-m-d",
            minDate: "today",
            maxDate: new Date().fp_incr(60), // 60 días hacia adelante
            disable: [
                function(date) {
                    // Deshabilitar domingos (0) y sábados (6)
                    return (date.getDay() === 0 || date.getDay() === 6);
                }
            ],
            onChange: function(selectedDates, dateStr, instance) {
                // Aquí se actualizarán los horarios disponibles
                actualizarHorariosDisponibles(dateStr);
            }
        });

        // Función para actualizar horarios disponibles
        function actualizarHorariosDisponibles(fecha) {
            const especialidad = document.getElementById('especialidad').value;
            const profesional = document.getElementById('profesional').value;
            
            if (!especialidad || !profesional) {
                return;
            }

            // Aquí se haría la llamada AJAX para obtener los horarios disponibles
            fetch('get_horarios_disponibles.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    fecha: fecha,
                    especialidad: especialidad,
                    profesional: profesional
                })
            })
            .then(response => response.json())
            .then(data => {
                mostrarHorariosDisponibles(data);
            })
            .catch(error => console.error('Error:', error));
        }

        // Función para mostrar los horarios disponibles
        function mostrarHorariosDisponibles(horarios) {
            const contenedor = document.querySelector('.horarios-disponibles');
            contenedor.innerHTML = '';

            if (horarios.length === 0) {
                contenedor.innerHTML = '<p class="no-horarios">No hay horarios disponibles para la fecha seleccionada</p>';
                return;
            }

            const grid = document.createElement('div');
            grid.className = 'horarios-grid';

            horarios.forEach(horario => {
                const boton = document.createElement('button');
                boton.className = 'btn-horario';
                boton.textContent = horario;
                boton.onclick = () => seleccionarHorario(horario);
                grid.appendChild(boton);
            });

            contenedor.appendChild(grid);
        }

        // Función para seleccionar un horario
        function seleccionarHorario(horario) {
            // Aquí se implementará la lógica para reservar el horario
            console.log('Horario seleccionado:', horario);
        }
    });
    </script>

    <?php include '../../components/footer.php'; ?>
</body>
</html>
