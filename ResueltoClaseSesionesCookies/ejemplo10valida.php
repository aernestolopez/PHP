<?php
include "ejemplo10comprueba.php";
if($_POST['user']=="david" && $_POST['pass']=="1234") {
    $_SESSION['user']=$_POST['user'];
    $_SESSION['nombre']=$_POST['nombre'];
    header("location:ejemplo10destino.php");
}
else {
    header("location:ejemplo10.php?message=Usuario o password incorrecto");
}
?>