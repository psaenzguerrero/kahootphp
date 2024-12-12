<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    echo $nombre;
    $usuarioId = $usuarioObj->insertar_usu($nombre);
    if (!$usuarioId) {
        header("Location: cuestionario.php?nombre=".$nombre);
        exit;
    } else {
        $error = "El nombre ya está registrado. Por favor, elige otro.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kahoot Clone</title>
</head>
<body>
    <div class="container">
        <h1>Bienvenido a Quiz</h1>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <form method="POST" action="">
            <input type="text" name="nombre" placeholder="Ingresa tu nombre" required>
            <button type="submit">Comenzar</button>
        </form>
    </div>
</body>
</html>
