<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST["tipoUsuario"])){
        $usuario = $_POST["tipoUsuario"];
    }
        if (isset($_POST["selectProducto"])){
        $productoSelect = $_POST["selectProducto"];
    }
        if (isset($_POST["cantidad"])){
        $cantidad = $_POST["cantidad"];
    }
    echo $usuario . " ". $productoSelect . " " . $cantidad;
    
}
    ?>