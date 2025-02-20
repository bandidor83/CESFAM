<?php
session_start();
require_once '../../config/database.php';

// Verificar si hay una sesión activa
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit(json_encode(['error' => 'No autorizado']));
}

// Obtener datos de la solicitud
$data = json_decode(file_get_contents('php://input'), true);
$fecha = $data['fecha'] ?? '';
$especialidad = $data['especialidad'] ?? '';
$profesional = $data['profesional'] ?? '';

// Validar datos
if (!$fecha || !$especialidad || !$profesional) {
    http_response_code(400);
    exit(json_encode(['error' => 'Datos incompletos']));
}

// Aquí implementarías la lógica para obtener los horarios disponibles desde la base de datos
// Por ahora, devolvemos horarios de ejemplo
$horarios_ejemplo = [
    '08:00', '08:30', '09:00', '09:30', '10:00',
    '10:30', '11:00', '11:30', '12:00', '12:30',
    '14:00', '14:30', '15:00', '15:30', '16:00'
];

// Devolver los horarios
header('Content-Type: application/json');
echo json_encode($horarios_ejemplo);
?> 