<?php
class Usuarios {
    private $id;
    private $nombre;
    private $correo;
    private $contrasena;
    private $tipo;

    public function __construct($nombre = null, $correo = null, $contrasena = null, $tipo = null) {
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->contrasena = $contrasena;
        $this->tipo = $tipo;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getCorreo() {
        return $this->correo;
    }

    public function getContrasena() {
        return $this->contrasena;
    }

    public function getTipo() {
        return $this->tipo;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setCorreo($correo) {
        $this->correo = $correo;
    }

    public function setContrasena($contrasena) {
        $this->contrasena = $contrasena;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function buscarPorCorreo($conn, $correo) {
        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            die("Error preparando la consulta: " . $conn->error);
        }

        $stmt->bind_param('s', $correo);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarioData = $result->fetch_assoc();
        $stmt->close();

        return $usuarioData;
    }
}
?>

