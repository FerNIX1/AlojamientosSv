<?php
require_once '../Model/Conexion/Conexion.php';
require_once '../Model/Usuarios.php';
require_once '../Controller/UsuarioControler.php';

try {
    $dbConnection = Conexion::getConexion();
} catch (Exception $e) {
    die("Error de conexión: " . $e->getMessage());
}

$mensaje = "";
$UsuarioControler = new UsuarioControler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo =  $_POST['correo'];
    $contrasena =  $_POST['contrasena'];

    if ($correo && $contrasena) {
        $usuario = $UsuarioControler->ValidarUsuario($correo, $contrasena);
        if ($usuario) {
            $mensaje = "Usuario válido: " . $usuario->getNombre();
            header("Location: VistaPrincipal.php");
        } else {
            $mensaje = "Usuario o contraseña no válidos.";
        }
    } else {
        $mensaje = "Por favor, ingrese un correo y una contraseña válidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Destinos SV</title>
    <link rel="stylesheet" href="Resources/css/index.css">
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="#" class="navbar-brand">Destinos SV</a>
  </div>
</nav>
<div class="container mt-4">
    <form name="formulario" method="post" action="">
        <h1>DESTINOS SV</h1>
        <div class="form-group">
            <label for="correo">Email address</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Enter email" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Password</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Password" required>
        </div>
        <div class="mt-3">
            <?php echo $mensaje; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Entrar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>







