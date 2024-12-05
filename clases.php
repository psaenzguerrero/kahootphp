<?php
    class usuario{
        private $bd;
        private $nombreUsuario;
        private $tiempoInicio;
        private $tiempoFinal;


        public function __construct($db,$n="",$tI="",$tF=""){
            $this->bd=$db;
            $this->nombre=$n;
            $this->tiempoInicio=$tI;
            $this->tiempoFinal=$tF;
        }
        public function insertar_usu(){
            $sen = "INSERT INTO usuarios(nombre,tiempoInicial) VALUES ('".$this->$n.",".$this->$tI.")";
            $cons = $this->bd->prepare($sen);
            $cons->blind_result($this->nombre);
            $cons->execute();

            $cons->close();
        }
        

    }
    class pregunta{
        private $bd;
        private $cod;
        private $pregunta;
        private $correcta;

        public function __construct($db,$c="",$p="",$corr=""){
            $this->bd=$db;
            $this->cod=$c;
            $this->pregunta=$p;
            $this->correcta=$corr;
        }

    }
?>