<?php
require_once '../Model/Reservas.php';

class ReservaController {
    public function crearReserva($id_usuario, $id_alojamiento, $fecha_inicio, $fecha_fin) {
        $reserva = new Reservas($id_usuario, $id_alojamiento, $fecha_inicio, $fecha_fin);
        var_dump($reserva);
        return $reserva->guardarReserva();
    }
}
?>


