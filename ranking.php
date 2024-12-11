<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    echo $nombre;
    $usuarioId = $usuarioObj->finalizarCuestionario($nombre);
}

$result = $conn->query("SELECT nombreUsuario, TIMESTAMPDIFF(SECOND, tiempoInicio, tiempoFinal) AS tiempo 
                        FROM usuarios 
                        WHERE tiempoFinal IS NOT NULL 
                        ORDER BY tiempo ASC");
$ranking = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Ranking</title>
</head>
<body>
    <h1>Ranking de Jugadores</h1>
    <table>
        <tr>
            <th>Nombre</th>
            <th>Tiempo (segundos)</th>
        </tr>
        <?php foreach ($ranking as $fila): ?>
            <tr>
                <td><?= $fila['nombreUsuario'] ?></td>
                <td><?= $fila['tiempo'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
