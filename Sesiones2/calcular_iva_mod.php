<?php
// calcular_iva_mod.php

function contadorProductos() {
    // Si no existe la lista de productos en la sesión, la creamos vacía
    if (!isset($_SESSION['lista_productos'])) {
        $_SESSION['lista_productos'] = [];
    }
    
    // El número del próximo ítem será el total actual más 1
    return count($_SESSION['lista_productos']) + 1;
}

function calcularPrecioConIva($precio) {
    $iva = 0.21; // 21% de IVA
    return round($precio * (1 + $iva), 2);
}