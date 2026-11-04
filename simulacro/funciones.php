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


function comprobarExistencias($productos, $codigo){
foreach($productos as $producto){
    if($producto["codigo"] === $codigo){
        if($producto["stock"] > 0){
            
        }
    }
}
}
//entero o positivo
function validarUnidades(){

}