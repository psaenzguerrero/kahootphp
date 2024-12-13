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
    <style>
        body{
            text-align: center;
            background-color: aquamarine;
            margin: 50px;
        }
        .container{
            background-color: rgba(255, 255, 255, 0.664);
            margin: 100px;
            padding: 50px;
            h1{
                font-size: 100px;
            }
            form{
                input, button{
                    padding: 20px;
                    font-size: 40px;
                    border-radius: 20px;
                }
                button:hover{
                    background-color: black;
                    color: white;
                }
            }
        }
    </style>
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
