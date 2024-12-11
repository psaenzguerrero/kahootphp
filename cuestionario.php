<?php
require_once 'clases.php';

$usuarioId = $_GET['user_id'];
$preguntas = $preguntaObj->obtenerPreguntasAleatorias();
$fin = $usuarioObj->finalizarCuestionario($usuarioId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cuestionario</title>
    <script>
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
                } else {
                    document.getElementById(`pregunta-${preguntaId}`).style.color = 'red';
                    // alert('Respuesta incorrecta. Intenta de nuevo.');
                }
            });
        }
    </script>
</head>
<body>
    <div class="">
        <?php foreach ($preguntas as $pregunta): ?>

            <div id="pregunta-<?= $pregunta['cod'] ?>">
                <h2><?= $pregunta['pregunta'] ?></h2>
                <input type="text" onblur="enviarRespuesta(<?= $pregunta['cod'] ?>, this.value)">
            </div>

        <?php endforeach; ?>
    </div>
    <a href=<?"ranking.php?nombre=$usuarioId"?>>ENVIAR</a>
</body>
</html>
