<?php
//Función que calcula el IVA (21% por defecto)
function calcularPrecioConIva(float $precio, float $iva = 0.21): float
{
return $precio * (1 + $iva);
}
// Función para contar cuántos productos se procesan en la ejecución actual
function contadorProductos(): int
{
    if(!isset($_SESSION["productos"])){
        $_SESSION["productos"] = [ ];
    }

    return count($_SESSION["productos"])+1;
}
?>