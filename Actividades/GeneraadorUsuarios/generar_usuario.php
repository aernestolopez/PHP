<?php
//formulario que pide nombre y apellidos y que genera un nombre de usuario con la primera letra del nombre las primeras 4 del 
//apellido y un numero entre 10 y 99 y que lo muestres METODO POST
if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $nombre = trim($_POST["nombre"] ?? '');
        $apellido = $_POST["apellido"] ?? '';
if (!empty($nombre && !empty($apellido))) {
    $primera_letra = substr($nombre, 0, 1);
    $cuatro_letras_apell = substr($apellido, 0, 4);
    $numbs = random_int(10,99);
    $sugerencia = $primera_letra . $cuatro_letras_apell . $numbs;
    $username = strtolower($sugerencia);
    echo $username;
} else {  
    echo "Añade nombre o apellido";
}
}
//if(isset($_POST["enviar"])){

//}
//probar con empty

//Array donde hay definido cadena valor
?>



