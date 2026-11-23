<!-- 
if (isset($_GET["mensaje"]) && is_string($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
} else {
    $mensaje = "Se ha producido un error inesperado";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error en el pedido</title>
</head>
<body>

<h1>Error en el pedido</h1>

<p><?= htmlspecialchars($mensaje) ?></p>

<p>
    <a href="index.php">Volver a la tienda</a>
</p>

</body>
</html>
-->

<?php
// Al ser un código pequeño, podemos mezclar código php y html así

if (isset($_GET["mensaje"]) && is_string($_GET["mensaje"])) {
    $mensaje = $_GET["mensaje"];
} else {
    $mensaje = "Se ha producido un error inesperado";
}

// 1. Aseguramos el contenido del mensaje
$mensajeSeguro = htmlspecialchars($mensaje);

// 2. Imprimimos el HTML
echo "<h1>Error en el pedido</h1>";
echo "<p>$mensajeSeguro</p>";
echo "<p><a href='index.php'>Volver a la tienda</a></p>";

?>
