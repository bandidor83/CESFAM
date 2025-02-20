<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';
require_once 'includes/functions.php';

$errors = [];
$success = false;

// Función para depuración
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug: " . $output . "');</script>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Depurar los datos recibidos
    debug_to_console("Datos POST recibidos: " . print_r($_POST, true));

    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $rut = trim($_POST['rut']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $tipo_usuario = $_POST['tipo_usuario'];
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    
    $errors = [];

    // Depurar valores de contraseñas
    debug_to_console("Password: " . $password);
    debug_to_console("Confirm Password: " . $confirm_password);

    // Validaciones básicas
    if (empty($nombre)) $errors[] = "El nombre es requerido";
    if (empty($apellido)) $errors[] = "El apellido es requerido";
    if (empty($rut)) $errors[] = "El RUT es requerido";
    if (empty($password)) $errors[] = "La contraseña es requerida";
    if (empty($tipo_usuario)) $errors[] = "El tipo de usuario es requerido";

    // Validación simple de contraseñas
    if ($password !== $confirm_password) {
        echo "<script>console.log('Password: " . $password . "');</script>";
        echo "<script>console.log('Confirm: " . $confirm_password . "');</script>";
        $errors[] = "Las contraseñas no coinciden";
    }

    // Verificar RUT único
    if (!empty($rut)) {
        try {
            $stmt = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE rut = ?");
            $stmt->execute([$rut]);
            if ($stmt->fetchColumn() > 0) {
                $errors[] = "Este RUT ya está registrado";
            }
        } catch(PDOException $e) {
            debug_to_console("Error verificando RUT: " . $e->getMessage());
            $errors[] = "Error al verificar el RUT";
        }
    }

    // Si no hay errores, proceder con el registro
    if (empty($errors)) {
        try {
            debug_to_console("Intentando registrar usuario...");
            
            // Hash de la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, apellido, rut, password, tipo_usuario, email, telefono, estado) 
                    VALUES (:nombre, :apellido, :rut, :password, :tipo_usuario, :email, :telefono, 'activo')";
            
            $stmt = $conn->prepare($sql);
            $result = $stmt->execute([
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':rut' => $rut,
                ':password' => $hashed_password,
                ':tipo_usuario' => $tipo_usuario,
                ':email' => $email,
                ':telefono' => $telefono
            ]);

            if ($result) {
                debug_to_console("Usuario registrado exitosamente");
                $_SESSION['mensaje'] = "Usuario registrado exitosamente";
                $_SESSION['mensaje_tipo'] = "success";
                header('Location: index.php');
                exit();
            }
        } catch(PDOException $e) {
            debug_to_console("Error en registro: " . $e->getMessage());
            $errors[] = "Error al registrar el usuario: " . $e->getMessage();
        }
    }

    // Si hay errores, guardarlos en la sesión
    if (!empty($errors)) {
        debug_to_console("Errores encontrados: " . implode(", ", $errors));
        $_SESSION['mensaje'] = implode("<br>", $errors);
        $_SESSION['mensaje_tipo'] = "error";
        $_SESSION['form_data'] = $_POST;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario - CESFAM</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <main class="registro-container">
        <h2>Registro de Usuario</h2>
        
        <?php
        // Mostrar mensajes de error o éxito
        if (isset($_SESSION['mensaje'])) {
            $tipo = $_SESSION['mensaje_tipo'] ?? 'info';
            echo "<div class='alert alert-{$tipo}'>{$_SESSION['mensaje']}</div>";
            unset($_SESSION['mensaje']);
            unset($_SESSION['mensaje_tipo']);
        }
        ?>

        <form id="registroForm" method="POST" action="registro.php" class="form-registro">
            <div class="form-group">
                <label for="reg_nombre">Nombre:</label>
                <input type="text" id="reg_nombre" name="nombre" required 
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['nombre'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="reg_apellido">Apellido:</label>
                <input type="text" id="reg_apellido" name="apellido" required 
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['apellido'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="reg_rut">RUT:</label>
                <input type="text" id="reg_rut" name="rut" required 
                       placeholder="Sin puntos y con guión"
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['rut'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="reg_password">Contraseña:</label>
                <input type="password" 
                       id="reg_password" 
                       name="password" 
                       required 
                       autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="reg_confirm_password">Confirmar Contraseña:</label>
                <input type="password" 
                       id="reg_confirm_password" 
                       name="confirm_password" 
                       required 
                       autocomplete="new-password">
            </div>

            <div class="form-group">
                <label for="reg_tipo_usuario">Tipo de Usuario:</label>
                <select id="reg_tipo_usuario" name="tipo_usuario" required>
                    <option value="">Seleccione tipo de usuario</option>
                    <option value="administrativo_some">Administrativo SOME</option>
                    <option value="medico">Médico</option>
                    <option value="enfermero">Enfermero</option>
                    <option value="kinesiologo">Kinesiólogo</option>
                    <option value="nutricionista">Nutricionista</option>
                    <option value="psicologo">Psicólogo</option>
                    <option value="trabajador_social">Trabajador Social</option>
                    <option value="matron">Matrón/a</option>
                    <option value="tens">TENS</option>
                    <option value="odontologo">Odontólogo</option>
                </select>
            </div>

            <div class="form-group">
                <label for="reg_email">Email:</label>
                <input type="email" id="reg_email" name="email" 
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['email'] ?? ''); ?>">
            </div>

            <div class="form-group">
                <label for="reg_telefono">Teléfono:</label>
                <input type="tel" id="reg_telefono" name="telefono" 
                       value="<?php echo htmlspecialchars($_SESSION['form_data']['telefono'] ?? ''); ?>">
            </div>

            <button type="submit" class="btn-submit">Registrar Usuario</button>
        </form>
    </main>

    <?php unset($_SESSION['form_data']); ?>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registroForm');
        
        form.addEventListener('submit', function(e) {
            const password = document.getElementById('reg_password').value;
            const confirmPassword = document.getElementById('reg_confirm_password').value;
            
            // Mostrar valores en consola para debug
            console.log('Password:', password);
            console.log('Confirm Password:', confirmPassword);
            
            if (password !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return false;
            }
        });

        // Formatear RUT
        const rutInput = document.getElementById('reg_rut');
        rutInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\./g, '').replace('-', '');
            value = value.replace(/[^\dkK]/g, '');
            
            if (value.length > 1) {
                value = value.slice(0, -1) + '-' + value.slice(-1);
            }
            
            e.target.value = value;
        });
    });
    </script>

    <?php include 'components/footer.php'; ?>
</body>
</html> 