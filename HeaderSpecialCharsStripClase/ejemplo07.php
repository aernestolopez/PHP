<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ejemplo 07</title>
</head>
<body>
<h1>Mi formulario</h1>
<body>
<?php
$nombre="";
$apellidos="";
$dni="";
if(!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['dni'])) {
    $nombre=$_POST['nombre'];
    $apellidos=$_POST['apellidos'];
    $dni=$_POST['dni'];
    $patron='/^[0-9]{8}[A-Z]{1}$/';
    if(preg_match($patron,$dni)) {
        header("location:ejemplo07destino.php");
    }
    else {
        echo "<h3>El DNI no es válido</h3>";
    }
}
else {
    echo "<h3>Rellena el formulario para poderte validar</h3>";
}
?>
<form action="ejemplo07.php" method="POST">
Nombre: <input type="text" name="nombre" value="<?php echo $nombre;?>"/><br />
Apellidos: <input type="text" name="apellidos" value="<?php echo $apellidos;?>"/><br />
<!-- Añadiendo al atributo value la sintaxis de php echo, me permite que tras pulsar el botón Enviar, los datos introducidos previamente no se borren -->
DNI: <input type="text" name="dni" value="<?php echo $dni;?>"/><br/>
<input type="submit" value="Enviar">
</form>
</body>
</body>
</html>