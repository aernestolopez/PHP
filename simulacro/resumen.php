<?php
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