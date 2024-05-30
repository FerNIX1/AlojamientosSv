<?php
require_once '../Model/Conexion/Conexion.php';
require_once '../Model/Usuarios.php';

class UsuarioControler {
    private $conn;

    public function __construct() {
        $this->conn = Conexion::getConexion();
    }

    public function ValidarUsuario($correo, $contrasena) {
        $usuario = new Usuarios();
        $usuarioData = $usuario->buscarPorCorreo($this->conn, $correo);

        if ($usuarioData) {
            if ($contrasena==$usuarioData['contrasena']) {
                $usuario->setId($usuarioData['id']);
                $usuario->setNombre($usuarioData['nombre']);
                $usuario->setCorreo($usuarioData['correo']);
                $usuario->setContrasena($usuarioData['contrasena']);
                $usuario->setTipo($usuarioData['tipo']);
                return $usuario;
            } else {
                echo "Contraseña incorrecta.";
                return false;
            }
        } else {
            echo "No se encontró el usuario.";
            return false;
        }
    }
}
?>


