<?php
//require_once("datos.php");
function buscarProductos($productos, $codigo){
    foreach($productos as $producto){
        if($producto["codigo"] === $codigo){
            return $producto;
        }
    }
    return null;
}


function comprobarExistencias($productos, $codigo, $cantPedido){
foreach($productos as $producto){
    if($producto["codigo"] === $codigo){
        if($producto["stock"] > 0 && $producto["stock"] >= $cantPedido){
            //$mensaje = "Hay stock";
            //return $mensaje;
            return 1;
            
        }else{
            //$mensaje = "No hay stock";
            //return $mensaje;
            return -1;
        }
    }
    //return null;
    return -1;
}

}

//entero o positivo
function validarUnidades($cantPedido){
    if(!is_int($cantPedido) && $cantPedido <= 0){
        return null;
    }else{
        return $cantPedido;
    }
}

function precioSubtotal($productos, $codigo, $cantPedido){
    foreach($productos as $producto){
        if ($producto["codigo"] === $codigo){
            $precioTotal=0;
            $precioTotal = $producto["precio"] * $cantPedido;
            return $precioTotal;
        }
    }
    return null;
}

function tipoDescuento($tipoUsuario){
    if($tipoUsuario ==="premium"){
        $mensaje = "Descuento del 10%";
        return $mensaje;
    }else if($tipoUsuario === "normal"){
        $mensaje = "Sin descuento";
        return $mensaje;
    }
    return null;
}
function descuento($precioTotal, $tipoUsuario){
    if($tipoUsuario === "premium"){
       $precioDescontado = $precioTotal * 0.9;
        return $precioDescontado;
    }else if($tipoUsuario === "normal"){
        return $precioTotal;
    }
    return null;
}

function procesarPedido($descuento, $total, $subtotal){
    return [
        'subtotal'  => $subtotal,
        'descuento' => $descuento,
        'total'     => $total
    ];

}

?>