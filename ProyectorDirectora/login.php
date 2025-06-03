<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

//* Arreglo con errores
$errores = [
    'matricula' => '',
    'password' => '',
    'credenciales' => ''
];

$matricula = "";
$password = "";

//? Validación básica
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $matricula = htmlspecialchars($_POST['matricula'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');

    if (empty($matricula)) {
        $errores['matricula'] = "La matrícula es obligatoria";
    }
    if (empty($password)) {
        $errores['password'] = "La contraseña es obligatoria";
    }
    
    // Verificar credenciales si no hay errores
    if (empty($errores['matricula']) && empty($errores['password'])) {
        $validMatricula = $_ENV['VALID_USER_MATRICULA'];
        $validPassword = $_ENV['VALID_USER_PASSWORD'];
        
        if ($matricula !== $validMatricula || $password !== $validPassword) {
            $errores['credenciales'] = "Matrícula o contraseña incorrectas";
        } else {
            // Credenciales correctas - redirigir o iniciar sesión
            session_start();
            $_SESSION['matricula'] = $matricula;
            $_SESSION['logged_in'] = true;
            
            header('Location: index.php'); // Cambia por tu ruta
            exit;
        }
    }
}

// Ajusta esta ruta según tu estructura real
require 'include/function.php';
incluirTemplate('header-forms-user');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    link
    <!-- Ajusta la ruta del CSS -->
    <link rel="stylesheet" href="styles/bundle.css">
    <style>
        .alerta.error {
            color: red;
            margin-top: 5px;
        }
        .formulario-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .formulario-grupo {
            margin-bottom: 15px;
        }
        .btn-submit {
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .error-credenciales {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container formulario-container">
    <form class="formulario-estudiante" method="POST">
        <h1>¡Bienvenidos!</h1>
        
        <?php if($errores['credenciales']): ?>
            <div class="error-credenciales"><?php echo $errores['credenciales']; ?></div>
        <?php endif; ?>
        
        <div class="formulario-grupo">
            <label for="matricula">Matrícula</label>
            <input type="text" id="matricula" name="matricula" value="<?php echo $matricula; ?>" required>
            <?php if($errores['matricula']): ?>
                <div class="alerta error"><?php echo $errores['matricula']; ?></div>
            <?php endif; ?>
        </div>
        
        <div class="formulario-grupo">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="password" required>
            <?php if($errores['password']): ?>
                <div class="alerta error"><?php echo $errores['password']; ?></div>
            <?php endif; ?>
            <button type="button" class="toggle-password" onclick="mostrarPassword('contrasena')">
                Mostrar
            </button>
        </div>
        
        <div class="formulario-grupo">
            <button type="submit" class="btn-submit">Iniciar sesión</button>
        </div>
    </form>
</div>

<script>
    function mostrarPassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>

<footer>
    <div class="content-slim">
        <p> &copy; <?php echo date('Y'); ?> | Universidad Tecnológica de Tamaulipas Norte</p>
    </div>
</footer>

<script src="public/js/index.js"></script>
<?php
// Cierra la conexión si es necesario
?>