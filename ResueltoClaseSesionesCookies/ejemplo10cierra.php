<?php
// Comprobamos si se están usando cookies para gestionar las sesiones
if (ini_get("session.use_cookies")) {
    // Almacenamos en una variable la información de la cookie
    $params = session_get_cookie_params();
    //Elimina el valor de la cookie estableciendo una valor para la misma de ''
    // Instante actual - 1 para obtener una fecha 
    // anterior a la actual y obligar al navegador a eliminar la cookie
    setcookie(session_name(), '', time() - 1,
    // Mantener los parámetros originales de la cookie 
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
}
//Elimina todas las sesiones abiertas
session_destroy();
//Devolvemos la ejecución al programa principal
header("location:ejemplo10.php");
?>