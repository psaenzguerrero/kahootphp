<?php
require_once 'clases.php';

$usuarioId = $_GET['nombre'];
$preguntas = $preguntaObj->obtenerPreguntasAleatorias();
//$fin = $usuarioObj->finalizarCuestionario($usuarioId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario</title>
    <style>
        #a{
            display: none;
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
        <?php foreach ($preguntas as $pregunta): ?>

            <div id="pregunta-<?= $pregunta['cod'] ?>">
                <h2><?= $pregunta['pregunta'] ?></h2>
                <input type="text" onblur="enviarRespuesta(<?= $pregunta['cod'] ?>, this.value)">
            </div>

        <?php endforeach; ?>
    </div>
    <a id="a" href=<?php echo "ranking.php?nombre=$usuarioId" ?>>ENVIAR</a>
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
                    // alert('¡Correcto!');
                    document.getElementById(`pregunta-${preguntaId}`).style.color = 'green';
                    cont = cont + 1;

                    console.log(cont);
                    if (cont<6) {
                        document.querySelector(`.c>div:nth-child(${cont})`).style.display="block";
                    }
                    
                    
                    if (cont == 6) {
                        document.getElementById("a").style.display="block";
                    }
                } else {
                    document.getElementById(`pregunta-${preguntaId}`).style.color = 'red';
                    // alert('Respuesta incorrecta. Intenta de nuevo.');
                }
            });
            
        }
    </script>
</body>
</html>
