<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ejemplo 06</title>
</head>
<body>
<h1>Mi formulario</h1>
<body>
<?php
if(isset($_GET['mensaje'])) {
    echo "<h3>".$_GET['mensaje']."</h3>";
}
?>
<form action="ejemplo06valida.php" method="POST">
Nombre: <input type="text" name="nombre"/><br />
Apellidos: <input type="text" name="apellidos"/><br />
DNI: <input type="text" name="dni"/><br/>
<input type="submit" value="Enviar">
</form>
</body>
</body>
</html>