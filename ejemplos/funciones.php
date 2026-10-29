<?php
    // Uso de variables static. Solo es visible dentro de la función donde se declaró
    echo "<br>Función contador_static: ";
    // CUando una función necesite recordar información de su ejecutación anterior

    function contador_static()  {
        static $inc=0; // Mantener el valor de la variable entre distintas llamadas a la función
        $inc++;
        echo "<br>El valor de la variable \$inc es: ". $inc;
    }

    contador_static();
    contador_static(); //A pesar de inicializarse a 0, al ser definida como static se tiene en cuenta solo la primera vez

    echo "<br><br>Función contador:";
    function contador(){
        $inc2 = 0;
        $inc2++;
        echo "<br>El valor de la variable \$inc2 es: ". $inc2;
    }
    contador();
    contador();

    $inc1 = 0;

    echo "<br><br>Función contador_global:";
    /**
     * Usaremos una variable global cuando múltiples partes
     * independientes del código accedan o modifiquen la misma información
     */

    function contador_global() {
        global $inc1;
        $inc1++;
        echo "<br>Dentro de función: El valor de la variable \$inc1 global es: ". $inc1;
    }
    contador_global();
    echo "<br>Fuera de función: El valor de la variable \$inc1 global es: ".$inc1;
    
    // Valores por defecto en los parámetros de una función
    $precio = 10;
    function precioConDescuento($precio, $descuento = 10) {
        return $precio * (100 - $descuento) / 100;
    }

    //Se asume que el segundo parámetro es 10
    $precioRebajado = precioConDescuento($precio);
    echo "<br><br>El precio con descuento estándar es: ". $precioRebajado;

    $precioRebajado = precioConDescuento($precio, 25);
    echo "<br>El precio con 25% de descuento es: ". $precioRebajado;

    $precioRebajado = precioConDescuento($precio, 50);
    echo "<br>El precio con 50% de descuento es: ". $precioRebajado;
    
    $precioRebajado = precioConDescuento($precio, 75);
    echo "<br>El precio con 75% de descuento es: ". $precioRebajado;
?>