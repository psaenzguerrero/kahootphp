<?php
require_once 'clases.php';
$usuarioId = $_GET['nombre'];
$preguntas = $preguntaObj->obtenerPreguntasAleatorias();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <style>
         body{
            text-align: center;
            background-color: rgb(74, 34, 138);
            margin: 50px;
            div{
                background-color: rgba(255, 255, 255, 0.664);
                margin: 100px;
                padding: 50px;
            }
            h2{
                font-size: 55px;
            }
            input{
                padding: 20px;
                font-size: 40px;
                border-radius: 20px;
            }
        }
        #a{
            display: none;
            background-color: darkgray;
            margin: 250px;
            padding: 50px;
            font-size: 40px;
            text-decoration: none;
            color: white;
            border-radius: 20px;
            font-weight: bold;
            border: 5px solid white;
        }
        #a:hover{
            border: 5px solid white;
            background-color: rgb(44, 47, 145);
            color: white;
        }
        .c>div:nth-child(2){
            display: none;
        }
        .c>div:nth-child(3){
            display: none;
        }
        .c>div:nth-child(4){
            display: none;
        }
        .c>div:nth-child(5){
            display: none;
        }
    </style>
</head>
<body>
    <div class="c">
        <!-- bucle para sacar las preguntas -->
        <?php foreach ($preguntas as $pregunta): ?>
            
            
            <div id="pregunta-<?= $pregunta['cod'] ?>">
                <h2><?= $pregunta['pregunta'] ?></h2>
                <input type="text" onblur="enviarRespuesta(<?= $pregunta['cod'] ?>, this.value)">
            </div>
            

        <?php endforeach; ?>
    </div>
    <!-- boton para llevar al ranking -->
    <a id="a" href=<?php echo "ranking.php?nombre=$usuarioId" ?>>ENVIAR</a>
    
    <!-- esta puta mierda que tengo aqui hecha me ha echo mas viejo pero en la base es una promesa que comprueba la verificacion  -->
    <script>
        let cont = 1;
        function enviarRespuesta(preguntaId, respuesta) {
            fetch('verificar_respuesta.php', {
                method: 'POST',
                body: JSON.stringify({ pregunta_id: preguntaId, respuesta }),
                headers: { 'Content-Type': 'application/json' }
            })
            .then(responde => responde.json())
            .then(data => {
                if (data.correcta) {
                    document.getElementById(`pregunta-${preguntaId}`).style.color = 'green';
                    document.querySelector(`.c>div:nth-child(${cont})`).style.display="none";
                    cont = cont + 1;
                    if (cont<6) {
                        document.querySelector(`.c>div:nth-child(${cont})`).style.display="block";
                    }
                    if (cont == 6) {
                        document.getElementById("a").style.display="block";
                        document.querySelector(`.c`).style.display="none";
                    }
                } else {
                    document.getElementById(`pregunta-${preguntaId}`).style.color = 'red';
                }
            });
            
        }
    </script>
</body>
</html>
