<?php
if(!isset($_POST['nombre'])){
    $mensaje= "Debes rellenar el formulario";
    header("location:index.php?mensaje=$mensaje");
}
elseif(empty($_POST["nombre"]) ||
empty($_POST["apellidos"]) ||
empty($_POST["direccion"]) ||
empty($_POST["poblacion"]) ||
empty($_POST["genero"]) ||
is_null($_POST["genero"])){

}