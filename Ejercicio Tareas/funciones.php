<?php

function limpiarSession(){
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    $_SESSION["tareas"]= [];
}

function limpiarTarea($nombreTarea):string{
    $limpio = strip_tags($nombreTarea);
    $limpio = strtolower($limpio);
    $limpio = ucfirst($limpio);
    $limpio = htmlspecialchars($limpio);
    $limpio = trim($limpio);
    return $limpio;
}

function busqueda($buscarTarea){
    $buscarTarea = strtolower($buscarTarea);
    foreach ($_SESSION["tareas"] as $indice => $tarea){
        if (strpos(strtolower($tarea), $buscarTarea) !== false) {
            $coincidencias[$indice] = $tarea;
        }else{
            $coincidencias = [];
        }

    }
    return $coincidencias;
}

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

?>