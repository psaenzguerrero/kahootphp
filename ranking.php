<?php
require_once 'clases.php';

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
                <td><?= $fila['nombre'] ?></td>
                <td><?= $fila['tiempo'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
