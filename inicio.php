<?php
require_once 'clases.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    echo $nombre;
    $usuarioId = $usuarioObj->insertar_usu($nombre);
    if ($usuarioId[0]) {
        header("Location: cuestionario.php?user_id=".$usuarioId[1]);
        exit;
    } else {
        $error = "El nombre ya está registrado. Por favor, elige otro.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
