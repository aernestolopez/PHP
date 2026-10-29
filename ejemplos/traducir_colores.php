<?php
    echo traducirColor("celeste");

    $valor = traducirColor("negro");
    echo "<br>$valor";

    function traducirColor(string $colorEspañol) : string {
        $diccionario = [
            'rojo' => 'red',
            'azul' => 'blue',
            'verde' => 'green',
            'amarillo' => 'yellow',
            'negro' => 'black'
        ];

        $colorFormateado = strtolower(trim($colorEspañol));

        if (!$diccionario[$colorFormateado]) {
            return "No se encuentra el color";
        } else {
            return $diccionario[$colorFormateado];
        }
    }

?>