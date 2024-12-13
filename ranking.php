<?php
require_once 'clases.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nombre = $_GET['nombre'];
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking</title>
    <style>
        body{
            text-align: center;
            background-color: aquamarine;
            margin: 50px;
            display: flex;
            flex-flow: column;
            justify-content: center;
            align-items: center;
            h1{
                font-size: 100px;
                background-color: rgba(255, 255, 255, 0.664);
                margin: 50px;
                padding: 50px;
            }
            table{
                text-align: center;
            }
            th{
                font-size: 50px;
                padding: 50px;
                border: 2px solid black;
                background-color: white;
            }
            td{
                padding: 50px;
                margin-top: 10px;
                border: 3px solid black;
                background-color: white;
                font-size: 40px;
                font-weight: bold;
            }
        }
    </style>
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
