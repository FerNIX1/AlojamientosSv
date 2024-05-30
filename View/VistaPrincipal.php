<?php
require_once '../Model/Alojamientos.php';
require_once '../Model/Conexion/Conexion.php';

$alojamientosModel = new Alojamientos();
$alojamientos = $alojamientosModel->obtenerAlojamientos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Vista Principal</title>
    <style>
        .fixed-size-img {
    height: 200px; 
    width: 100%; 
    object-fit: cover;
}
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a href="#" class="navbar-brand">Destinos SV</a>
  </div>
</nav>
<div class="container mt-4">
    <div class="row">
        <?php foreach ($alojamientos as $alojamiento): ?>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="<?php echo $alojamiento['imagen']; ?>" class="card-img-top img-fluid fixed-size-img" alt="Imagen del alojamiento">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $alojamiento['nombre']; ?></h5>
                        <p class="card-text"><?php echo $alojamiento['descripcion']; ?></p>
                        <p class="card-text"><strong>Precio:</strong> $<?php echo $alojamiento['precio_por_noche']; ?> por noche</p>
                        <a href="ReservarAlojamiento?id=<?php echo $alojamiento['id']; ?>" class="btn btn-primary">Reservar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>




