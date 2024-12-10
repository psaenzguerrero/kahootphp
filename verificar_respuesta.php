<?php
require_once 'clases.php';

$data = json_decode(file_get_contents('php://input'), true);
$preguntaId = $data['pregunta_id'];
$respuesta = $data['respuesta'];

$isCorrecta = $preguntaObj->verificarRespuesta($preguntaId, $respuesta);

echo json_encode(['correcta' => $isCorrecta]);
?>
