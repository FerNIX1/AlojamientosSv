<?php
require_once '../Model/Conexion/Conexion.php';

class Reservas {
    private $id;
    private $id_usuario;
    private $id_alojamiento;
    private $fecha_inicio;
    private $fecha_fin;
    private $estado;
    private $fecha_creacion;

    public function __construct($id_usuario, $id_alojamiento, $fecha_inicio, $fecha_fin, $estado = 'pendiente', $fecha_creacion = null) {
        $this->id_usuario = $id_usuario;
        $this->id_alojamiento = $id_alojamiento;
        $this->fecha_inicio = $fecha_inicio;
        $this->fecha_fin = $fecha_fin;
        $this->estado = $estado;
        $this->fecha_creacion = $fecha_creacion ?? date('Y-m-d H:i:s');
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getIdAlojamiento() {
        return $this->id_alojamiento;
    }

    public function getFechaInicio() {
        return $this->fecha_inicio;
    }

    public function getFechaFin() {
        return $this->fecha_fin;
    }

    public function getEstado() {
        return $this->estado;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function setIdAlojamiento($id_alojamiento) {
        $this->id_alojamiento = $id_alojamiento;
    }

    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }

    public function setFechaFin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    // Método para guardar reserva
    public function guardarReserva() {
        $conn = Conexion::getConexion();
        $sql = "INSERT INTO reservas (id, id_usuario, id_alojamiento, fecha_inicio, fecha_fin, estado, fecha_creacion) VALUES (NULL, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iissss", $this->id_usuario, $this->id_alojamiento, $this->fecha_inicio, $this->fecha_fin, $this->estado, $this->fecha_creacion);
        $stmt->execute();
        
        // Asignar el ID generado por la base de datos a la instancia actual
        $this->id = $stmt->insert_id;

        return $stmt->affected_rows > 0;
    }
}


?>