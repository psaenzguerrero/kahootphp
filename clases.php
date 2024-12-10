<?php
// Configuración de la base de datos
$host = 'localhost';
$db_name = 'kahoot';
$username = 'root';
$password = '';
$conn = new mysqli($host, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Clase Usuario
class Usuario {
    private $bd;
    private $nombreUsuario;
    private $tiempoInicio;
    private $tiempoFinal;

    public function __construct($db, $n = "", $tI = "", $tF = "") {
        $this->bd = $db;
        $this->nombreUsuario = $n;
        $this->tiempoInicio = $tI;
        $this->tiempoFinal = $tF;
    }

    public function insertar_usu($n) {
        $n = $this->bd->real_escape_string($n);

        // Verificar si el nombre ya existe
        $result = $this->bd->query("SELECT * FROM usuarios WHERE nombreUsuario='$n'");

        if ($result->num_rows > 0) {
            return false; 
        }

        // Registrar el usuario
        $this->bd->query("INSERT INTO usuarios (nombreUsuario, tiempoInicio) VALUES ('$n', NOW())");

        if($this->bd->affected_rows == 1)
            return [true, $this->bd->insert_id]; // Retornar el usuario creado
        else
            return [false, $this->bd->insert_id];
   
    }

    public function finalizarCuestionario($n) {
        $this->bd->query("UPDATE usuarios SET tiempoFinal = NOW() WHERE nombreUsuario = $n");
    }
}

// Clase Pregunta
class Pregunta {
    private $bd;
    private $cod;
    private $pregunta;
    private $correcta;

    public function __construct($db, $c = "", $p = "", $corr = "") {
        $this->bd = $db;
        $this->cod = $c;
        $this->pregunta = $p;
        $this->correcta = $corr;
    }

    public function obtenerPreguntasAleatorias($cantidad = 5) {
        $result = $this->bd->query("SELECT * FROM preguntas ORDER BY RAND() LIMIT $cantidad");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function verificarRespuesta($c, $respuesta) {
        $c = (int)$c;
        $respuesta = $this->bd->real_escape_string($respuesta);

        $result = $this->bd->query("SELECT correcta FROM preguntas WHERE cod = $c");
        $row = $result->fetch_assoc();

        return strtolower($respuesta) === strtolower($row['correcta']);
    }
}


$usuarioObj = new Usuario($conn);
$preguntaObj = new Pregunta($conn);
?>
