<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if(isset($_GET['mensaje'])){
    $mensaje=strip_tags($_GET['mensaje']);
    echo "<h4>$mensaje</h4>";
}
?>
    <form action="u03_a02_cp_destino.php" method="POST">
        Nombre: <input type="text" name="nombre"/><br/>
        Apellidos: <input type="text" name="apellidos"/><br/>
        Dirección: <input type="text" name="direccion"/><br/>
        Población: <input type="text" name="pobacion"/><br/>
        Género: Masculino <input type="radio" name="genero" value="masculino"/>
        Femenino <input type="radio" name="genero" value="femenino"/><br/>
        He leído y acepto las condicions de la página web
        <input type="checkbox" name="acepto"/><br/>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>