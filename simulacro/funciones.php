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
            $mensaje = "Hay stock";
            return $mensaje;
            
        }else{
            $mensaje = "No hay stock";
            return $mensaje;
        }
    }
    return null;
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

function descuento($precioTotal, $tipoUsuario){
    if($tipoUsuario === "premium"){
       $precioDescontado = $precioTotal * 0.9;
        return $precioDescontado;
    }else{
        return $precioTotal;
    }
}

function procesarPedido($tipoUsuario, $precioTotal, $subtotal){



//    return [
//        'subtotal'  => $subtotal,
//        'descuento' => $descuento,
//        'total'     => $total
//    ];

}