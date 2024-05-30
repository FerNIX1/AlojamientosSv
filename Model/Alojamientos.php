<?php
require_once '../Model/Conexion/Conexion.php';

class Alojamientos {
    private $id;
    private $nombre;
    private $descripcion;
    private $direccion;
    private $ciudad;
    private $pais;
    private $precio_por_noche;
    private $capacidad;
    private $fecha_creacion;
    private $imagen;

    public function __construct($nombre = null, $descripcion = null, $direccion = null, $ciudad = null, $pais = null, $precio_por_noche = null, $capacidad = null, $fecha_creacion = null, $imagen = null) {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->direccion = $direccion;
        $this->ciudad = $ciudad;
        $this->pais = $pais;
        $this->precio_por_noche = $precio_por_noche;
        $this->capacidad = $capacidad;
        $this->fecha_creacion = $fecha_creacion;
        $this->imagen = $imagen;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getCiudad() {
        return $this->ciudad;
    }

    public function getPais() {
        return $this->pais;
    }

    public function getPrecioPorNoche() {
        return $this->precio_por_noche;
    }

    public function getCapacidad() {
        return $this->capacidad;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function getImagen() {
        return $this->imagen;
    }

    // Setters
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setCiudad($ciudad) {
        $this->ciudad = $ciudad;
    }

    public function setPais($pais) {
        $this->pais = $pais;
    }

    public function setPrecioPorNoche($precio_por_noche) {
        $this->precio_por_noche = $precio_por_noche;
    }

    public function setCapacidad($capacidad) {
        $this->capacidad = $capacidad;
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function obtenerAlojamientos() {
        $conn = Conexion::getConexion();
        $sql = "SELECT * FROM alojamientos";
        $result = $conn->query($sql);

        $alojamientos = [];
        while ($row = $result->fetch_assoc()) {
            $alojamientos[] = $row;
        }
        return $alojamientos;
    }

    public function obtenerAlojamientoPorId($id) {
        $conn = Conexion::getConexion();
        $sql = "SELECT * FROM alojamientos WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
}
?>
