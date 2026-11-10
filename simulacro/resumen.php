<?php
require_once("datos.php");
require_once("funciones.php");
if(isset($_GET["codigo"]) && isset($_GET["cantidad"]) &&  
    isset($_GET["tipoCliente"])){
    $codigo = $_GET["codigo"];
    $cantidad = $_GET["cantidad"];
    $tipoCliente = $_GET["tipoCliente"];
}else{
    $mensaje = "Se ha producido un error inesperado";
}

echo $codigo . " " . $cantidad ." " . $tipoCliente .  " ";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen</title>
</head>
<body>
<p>Producto: <?php $indice = array_search($codigo, array_column($productos, 'codigo'));
echo $productos[$indice]["producto"]; ?></p>
</body>
</html>