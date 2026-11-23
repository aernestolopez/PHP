<?php

// Ejecución de pruebas
echo traducirColor('verde');     // Imprime: green
echo traducirColor('VERde  ');   // Imprime: green (gracias al trim y strtolower)
echo traducirColor("celeste");   // Imprime: Los colores disponibles son: rojo, azul, verde, amarillo, negro
$valor = traducirColor(' negro');
echo "<br>$valor";

function traducirColor(string $colorEspanol): string 
{
     $diccionario = [
        'rojo' => 'red',
        'azul' => 'blue',
        'verde' => 'green',
        'amarillo' => 'yellow',
        'negro' => 'black'
    ];
    
    $colorLimpio = strtolower(trim($colorEspanol));
    // Si existe el color que se le ha pasado ...
    if (isset($diccionario[$colorLimpio])) 
    {
        // Devuelve el contenido del mismo
        return $diccionario[$colorLimpio];
    }

    // Extraer sólo los nombres de las claves
    //Opción 1 (Utilizando array_keys e implode)
    //$lista_colores = array_keys($diccionario);
    //$coloresTexto = implode(', ', $lista_colores);   
    
    //Opción 2. Bucle foreach
    // Recorremos el diccionario para quedarnos solo con las claves ($color)
    
    /*Recorremos el array $diccionario y en cada iteración,
    almacenamos la clave en $color y el valor de la misma en $traduccion*/
    foreach ($diccionario as $color => $traduccion) {
        $lista_colores[] = $color; // Vamos guardando cada color en nuestro nuevo array
    }
    
    // Al final, usamos implode solo para juntarlos con comas
    $coloresTexto = implode(', ', $lista_colores);  
    return "<br>Color no encontrado. Los colores disponibles son: " . $coloresTexto; 
}


?>
