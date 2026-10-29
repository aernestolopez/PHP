<?php
//comprobarlos con todos
if(!isset($_POST['nombre'])){

    $mensaje= "Debes rellenar el formulario";
    
    header("location:index.php?mensaje". urldecode($mensaje));
}
elseif(empty($_POST["nombre"]) ||
empty($_POST["apellidos"]) ||
empty($_POST["direccion"]) ||
empty($_POST["poblacion"]) ||
empty($_POST["genero"]) ||
is_null($_POST["genero"])){

$mensaje= "Debes rellenar todos los campos del formulario";
    header("location:index.php?mensaje=". urldecode($mensaje));

}
elseif(!isset($_POST['acepto']) || empty($_POST['acepto'])){
$mensaje = 'Debes aceptar las políticas';
    header("location:index.php?mensaje=". urldecode($mensaje));
}

elseif(preg_match('/^[0-9]{5}-[\p{L} ]+$/u', $_POST['poblacion'])){
    $mensaje= 'La población no cumple con el formato establecido';
    header("location:index.php?mensaje=$mensaje");
}
else{
    $nombre = strip_tags($_POST["nombre"]);
    $apellidos = strip_tags($_POST["apellidos"]);
    $genero= strip_tags($_POST["genero"]);

    /*if($genero== "masculino"){
        $bienvenida="Bienvenido";
    }else{
        $bienvenida= "Bienvenida";
    }*/
    $bienvenida=($genero=="masculino"?"Bienvenido, " : "Bienvenida, ");

    echo $bienvenida.$nombre." ".$apellidos;
}



?>