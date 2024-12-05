<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        require_once "clases.php";
        $db = new mysqli('localhost','root','','kahoot');
        $db->set_charset("UTF8");

        if (isset($_POST["enviar"])) {
            $usuario= new usuario($_POST["nombre"]);
        }else{
    ?>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" value="nombre" placeholder="Introduce tu nombre">
                <input type="submit" value="enviar">
            </form>
    <?php
        }
    ?>
</body>
</html>