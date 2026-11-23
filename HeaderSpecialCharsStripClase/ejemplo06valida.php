<?php
//Uso de la función header
if(!empty($_POST['nombre']) && !empty($_POST['apellidos']) && !empty($_POST['dni'])) {
    $dni=$_POST['dni'];
    $patron='/^[0-9]{8}[A-Z]{1}$/';
    if(preg_match($patron,$dni)) {
        //Forzamos el salto al archivo ejemplo06destino.php
        header("location:ejemplo06destino.php");
    }
    else {
        $mensaje="El DNI no es válido";
        //También podemos usar header para pasarle datos a la página invocada, tal como hace el método GET
        header("location:ejemplo06.php?mensaje=$mensaje");
    }
}
else {
    $mensaje="Rellena el formulario para poderte validar";
    header("location:ejemplo06.php?mensaje=$mensaje");
}

/*Para que header() funcione, no debe haber ningún tipo de salida previa en el script (ni texto HTML, ni espacios en blanco, ni un echo o print), de lo contrario PHP lanzará un error de headers already sent aunque depende del servidor */
?>
