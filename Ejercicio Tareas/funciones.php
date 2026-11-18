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

?>