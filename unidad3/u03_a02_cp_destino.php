<?php
if(!isset($_POST['nombre'])){
    $mensaje= "Debes rellenar el formulario";
    header("location:index.php?mensaje=$mensaje");
}