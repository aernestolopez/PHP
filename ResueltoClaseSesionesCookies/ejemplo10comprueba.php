<?php
session_start();
// Si existe la variable login_time
if(isset($_SESSION['inicio'])) {
    if(time()-$_SESSION['inicio'] > 60) {
       header("location:ejemplo10.php?message=Inactividad. Inicia sesión de nuevo");
    }
}
else {
    header("location:ejemplo10.php?message=Debes iniciar sesión");
}
?>