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
        $existe=true;
        // Verificar si el nombre ya existe
        $result = $this->bd->prepare("SELECT * FROM usuarios WHERE nombreUsuario=?");
        $result->bind_param('s',$n);
        $result->execute();
        


        if ($result->num_rows > 0) {
            $result->close();
            echo "Usuario ya existente";
        }else{
            $result->close();
            $sent2=$this->bd->prepare("INSERT INTO usuarios (nombreUsuario) VALUES ('$n')");
            $sent2->execute();
            $existe = false;
            
        }

        // Registrar el usuario
        
        return $existe;
    }

    public function finalizarCuestionario($n) {
        $sent3=$this->bd->prepare("UPDATE usuarios SET tiempoFinal = NOW() WHERE nombreUsuario = '$n'");
        $sent3->execute();
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
