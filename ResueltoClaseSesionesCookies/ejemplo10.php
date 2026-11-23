<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Ejemplo 10</title>
</head>
<body>
<h1>Sesiones</h1>
<!-- 
Con GET y POST enviamos datos en una petición.
Con COOKIE almacenamos datos en el navegador.
Con SESSION almacenamos datos en el servidor y utilizamos normalmente una cookie para identificar al usuario. -->

<body>
<?php 
session_start();
//Guardar el momento de inicio de sesión
$valor = $_SESSION["inicio"]=time();
//$fecha = time();
//echo date("d/m/Y H:i:s", $fecha);

if(isset($_GET['message'])) {
    echo "<h3>".$_GET['message']."</h3>";
}
?>
<!-- Se utiliza el atributo autocomplete="off" para indicar al navegador que no queremos que sugiera ni complete automáticamente los datos del campo 
Si el campo es de tipo password se usa autocomplete = "new-password o current-password para indicar al navegador que ese campo está destinado a introducir una contraseña nueva (formulario de registro) o una contraseña que ya existe (formulario de inicio de sesión) -->
<form action="ejemplo10valida.php" method="POST" autocomplete="off">
Usuario: <input type="text" name="user" autocomplete="off" /><br />
Contraseña: <input type="password" name="pass" autocomplete="new-password"/><br />
Nombre completo: <input type="text" name="nombre" autocomplete="off"/><br/>
<input type="submit" name = "Enviar" value="Enviar">
</form>
</body>
</html>