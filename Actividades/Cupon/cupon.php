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

/*function comprobar_cupon(string $cupon, $cupones_validos):int{
    if (array_key_exists($cupon, $cupones_validos)) {
        return $cupones_validos[$cupon];
    }
        return "No hay descuento";
        
}*/

function calcular_descuento(string $cupon, array $cupones, float $precio): float {
    if (array_key_exists($cupon, $cupones)) {
        $porcentaje = $cupones[$cupon];
        return $precio - ($precio * ($porcentaje / 100));
    }
    return $precio;
}

function calcularDescuento1(string $cupon, array $lista_cupones, float $precio):float{
    foreach ($lista_cupones as $codigo_cupon => $descuento){
        if($cupon == $codigo_cupon){
            return $precio - ($precio * ($descuento/100));
        }
        return $precio;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $cupon_intro = limpiar_cupon($_POST["cupon"] ?? "");

    if (array_key_exists($cupon_intro, $cupones_validos)) {
        $precio_final = calcularDescuento1($cupon_intro, $cupones_validos, $precio_original);
        $mensaje = "¡Cupón aplicado con éxito! Descuento del " . $cupones_validos[$cupon_intro] . "%";
    } else {
        $mensaje = "El cupón introducido no es válido.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
    <form method="POST">
    <h1>Tu Carrito</h1>
    <p><b>Producto:</b> Curso de PHP Master</p>
    <p><b>Precio Base:</b> 100€</p>
    <p>¿Tienes un cupón?</p>
    <input type="text" name="cupon" placeholder="Ej: VERANO20" value="<?= htmlspecialchars($_POST['cupon'] ?? '')?>"/>
    <button name="enviar" type="submit">Aplicar</button> 
 <?php if (!empty($mensaje)): ?>
            <p><strong><?= $mensaje ?></strong></p>
        <?php endif; ?>
    <hr>
    <br />
     <p><b>Total a pagar: <?= $precio_final ?>€</b></p>
    <!--<p><b>Total a pagar: 100€</b></p>-->
</form>
</body>
</html>