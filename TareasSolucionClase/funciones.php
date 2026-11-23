<?php

/**
 * Limpia el texto de espacios y etiquetas HTML, y pone la primera letra en mayúscula.
 */
function limpiarTexto(string $texto): string {
    $texto = trim($texto);
    $texto = strip_tags($texto);
    $texto = strtolower($texto);
    return ucfirst($texto);
}

/**
 * Filtra las tareas que contengan el texto buscado (sin distinguir mayúsculas/minúsculas).
 * Mantiene los índices originales del array para poder borrar correctamente.
 */
function filtrarTareas(array $tareas, string $busqueda): array {
    $busqueda = trim($busqueda);
    if ($busqueda === '') {
        return $tareas;
    }

    $busquedaMin = strtolower($busqueda);
    $resultados = [];

    foreach ($tareas as $indice => $tarea) {
        $tareaMin = strtolower($tarea);
        // Buscamos la cadena $tareaMin en la cadena $busquedaMin
        if (strpos($tareaMin, $busquedaMin) !== false) {
            // Conservamos la clave $indice original para que unset() funcione al filtrar
            $resultados[$indice] = $tarea;
        }
    } 

  

    return $resultados;
}
