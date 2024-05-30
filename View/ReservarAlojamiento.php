<?php
require_once '../Model/Alojamientos.php';
require_once '../Controller/ReservaController.php';

// Obtener el ID del alojamiento desde la URL
$id_alojamiento = isset($_GET['id']) ? $_GET['id'] : null;

if (!$id_alojamiento) {
    die("Error: ID de alojamiento no especificado.");
}

// Obtener detalles del alojamiento
$alojamientoModel = new Alojamientos();
$alojamiento = $alojamientoModel->obtenerAlojamientoPorId($id_alojamiento);

if (!$alojamiento) {
    die("Error: Alojamiento no encontrado.");
}

// Procesar la reserva
$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    if (isset($_SESSION['usuario_id'])) {
        $id_usuario = $_SESSION['usuario_id'];
        $fecha_inicio = $_POST['fecha_inicio'];
        $fecha_fin = $_POST['fecha_fin'];

        if ($fecha_inicio && $fecha_fin) {
            $reservaController = new ReservaController();
            $resultado = $reservaController->crearReserva($id_usuario, $id_alojamiento, $fecha_inicio, $fecha_fin);
            if ($resultado) {
                $mensaje = "Reserva realizada con éxito.";
            } else {
                $mensaje = "Error al realizar la reserva.";
            }
        } else {
            $mensaje = "Por favor, ingrese fechas de inicio y fin válidas.";
        }
    } else {
        $mensaje = "Por favor, inicia sesión para realizar una reserva.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Reservar Alojamiento</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="#" class="navbar-brand">Destinos SV</a>
  </div>
</nav>
<div class="container mt-4">
    <h1>Reservar Alojamiento</h1>
    <div class="card mb-4">
        <img src="<?php echo $alojamiento['imagen']; ?>" class="card-img-top img-fluid" alt="Imagen del alojamiento">
        <div class="card-body">
            <h5 class="card-title"><?php echo $alojamiento['nombre']; ?></h5>
            <p class="card-text"><?php echo $alojamiento['descripcion']; ?></p>
            <p class="card-text"><strong>Precio:</strong> $<?php echo $alojamiento['precio_por_noche']; ?> por noche</p>
        </div>
    </div>
    <form method="post" action="">
        <div class="form-group">
            <label for="fecha_inicio">Fecha de Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha de Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
        </div>
        <div class="mt-3">
            <?php echo $mensaje; ?>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Reservar</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



