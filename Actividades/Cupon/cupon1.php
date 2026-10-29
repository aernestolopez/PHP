<?php
//2 funciones:
//1 quitar espacio blanco y ponerlo en miniscula
//calcular descuento funcion recibe string cupon la otra recibe el cupon, el array, y el precio origen

$cupones_validos = [
    "verano20" => 20,
    "bienvenida" => 10,
    "blackfriday" => 50,
    "cyber25" => 25
];

$mensaje= "";
$precio_original = 100.00;
$precio_final = 100.00;

function limpiar_cupon(string $cupon):string{
    $cupon_format = trim($cupon);
    $cupon_format = strtolower($cupon_format);
    return $cupon_format;
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cupon_intro = limpiar_cupon($_POST["cupon"]);
    echo $cupon_intro;
}



?>
