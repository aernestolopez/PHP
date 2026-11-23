
<?php

// Busca un producto por su código.
function buscarProducto($productos, $codigo) {
    foreach ($productos as $producto) {
        // Con === se comprueba que valores y tipos sean iguales
        if ($producto["codigo"] === $codigo) {
            return $producto;
        }
    }

    return null;
}

// Calcula el subtotal de una línea del pedido.
// Se llama dentro de la función procesarPedido
function calcularSubtotal($precio, $unidades) {
    return $precio * $unidades;
}

// Comprueba que las unidades sean un entero positivo.
function validarUnidades($unidades) {
    // Si el dato numérico no es una cadena o está vacía
    if (trim($unidades) === "") {
        return false;
    }

    $unidades = trim($unidades);
    //Si la cadena contiene sólo dígitos
    if (!ctype_digit($unidades)) {
        return false;
    }
    // Devuelve true el número de unidades es positivo.
    
    $unidadesEntero = (int)$unidades;

    if ($unidadesEntero > 0) {
        return true;
    } else {
     return false;
    } 

    //return (int)$unidades > 0;
}

// Comprueba si hay existencias suficientes.
function comprobarStock($producto, $unidades) {
    return $producto["stock"] >= $unidades;
    // if($producto["stock"] >= $unidades) 
    // return true;
    // else return false;
}

// Calcula el descuento según el tipo de cliente.
// Cliente premium: 10 % de descuento.
// Cliente normal: sin descuento.
// Se llama dentro de la función procesarPedido

function calcularDescuento($subtotal, $tipoCliente) {
    $tipoCliente = strtolower(trim($tipoCliente));

    if ($tipoCliente === "premium") {
        return $subtotal * 0.10;
    }

    return 0;
}

// Procesa un pedido y devuelve sus importes.
// Se le llama en el archivo resumen.php
function procesarPedido($producto, $unidades, $tipoCliente) :array{

    $subtotal = calcularSubtotal($producto["precio"],$unidades);

    $descuento = calcularDescuento($subtotal,$tipoCliente);

    $total = $subtotal - $descuento;

    $pedido = [
        "subtotal" => $subtotal,
        "descuento" => $descuento,
        "total" => $total
    ];

    return $pedido;

    /* return [
        "subtotal" => $subtotal,
        "descuento" => $descuento,
        "total" => $total
    ]; */
}
