<?php

if(isset($_GET["mensaje"]) && is_string($_GET["mensaje"])){
    $mensaje = $_GET["mensaje"];
}else{
    $mensaje = "Se ha producido un error inesperado";
}

$mensajeSeguro = htmlspecialchars($mensaje);

echo "<h1>Error en el pedido</h1>";
echo "<p>$mensajeSeguro</p>";
echo "<p><a href='index.php'>Volver a la tienda";