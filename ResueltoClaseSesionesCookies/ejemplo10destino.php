<?php
include "ejemplo10comprueba.php";
if(!isset($_SESSION["nombre"])) {
    header("location:ejemplo10.php?message=Debes iniciar sesión");
}
echo "Hola, ".$_SESSION['nombre'];
echo "<br/>";
?>
<a href="ejemplo10cierra.php">Cerrar sesión</a>