<?php
// Diccionario de países y sus capitales (Array asociativo)
$capitales = [
    "España" => "Madrid",
    "Francia" => "París",
    "Italia" => "Roma",
    "Argentina" => "Buenos Aires",
    "Mexico" => "Ciudad de México"
];

$resultado = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Convertimos a minúsculas para evitar problemas con las mayúsculas del usuario
    $pais = ucfirst(strtolower(trim($_POST['pais'] ?? '')));

    // array_key_exists comprueba si la clave existe en el array asociativo
    // array_key devuelve un array con todas las claves del array
    if (array_key_exists($pais, $capitales)) {
        $resultado = "La capital de " . ucfirst($pais) . " es <strong>" . $capitales[$pais] . "</strong>.";
    } else {
        $resultado = "Lo siento, no tengo ese país en mi base de datos.";
    }
}
if($resultado)
    {
        echo $resultado;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejercicio 1</title></head>
<body>
    <h1>Buscador de Capitales</h1>
    <form method="POST">
        <label>Escribe un país (España, Francia, Italia, Argentina, Mexico):</label><br>
        <input type="text" name="pais" required>
        <button type="submit">Buscar</button>
    </form>
    


  <!--  <?php if ($resultado): ?>
        <p><?php echo $resultado; ?></p>
    <?php endif; ?> -->
</body>
</html>