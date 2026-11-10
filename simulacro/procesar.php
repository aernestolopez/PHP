<?php
require_once("funciones.php");
require("datos.php");

if($_SERVER["REQUEST_METHOD"] !=="POST"){
    $mensaje = "Método utilizado no válido";
    header("Location:error.php?mensaje= ".$mensaje);
    exit;
}

if(empty($_POST["tipoUsuario"]) || empty($_POST["selectProducto"]) || empty($_POST["cantidad"])){
    $mensaje = "Faltan datos";
     header("Location:error.php?mensaje= ".urlencode($mensaje));
     exit;
}
    $usuario = strtolower(trim($_POST["tipoUsuario"]));
    $productoSelect = strtoupper($_POST["selectProducto"]);
    $cantidad = trim($_POST["cantidad"]);

    $producto = buscarProductos($productos, $productoSelect);
    if($producto === null){
        $mensaje="Producto no localizado";
        header("Location:error.php?mensaje= ".urlencode($mensaje));
        exit;
    }

    $cantidadSanitizada = validarUnidades($cantidad);
    if($cantidadSanitizada === null){
        $mensaje="La unidad no es válida";
        header("Location:error.php?mensaje= ".urlencode($mensaje));
        exit;
    }else{
        $comprExistencias = comprobarExistencias($productos, $productoSelect, $cantidadSanitizada);
        if($comprExistencias === -1){
        $mensaje = "No hay suficiente stock";
        echo $mensaje;
        header("Location:error.php?mensaje= ". urlencode($mensaje));
        exit;
    }
    
    }
    
    $tipoDescuento = tipoDescuento($usuario);
    if($tipoDescuento === null){
        $mensaje="El tipo de usuario no es válido";
        header("Location:error.php?mensaje= ".urldecode($mensaje));
        exit;
    }

    //En el método precioSubtotal enviamos como parámetros variables ya comprobadas
    $precio = precioSubtotal($productos, $producto["codigo"], $cantidadSanitizada);


    $descuento = descuento($precio, $usuario);
        if($precio === null){
        $mensaje="Error Descuento: El tipo de usuario no es válido";
        header("Location:error.php?mensje= ".urldecode($mensaje));
        exit;
    }

    $pedidoProcesado = procesarPedido($tipoDescuento, $precio, $descuento );

    print_r($pedidoProcesado);

    header("Location:resumen.php?codigo=". urlencode($producto["codigo"]) . "&cantidad=". urldecode($cantidadSanitizada) . "&tipoCliente=" . urldecode($usuario));
    exit;
    ?>