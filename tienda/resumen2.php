<?php
require_once "datos.php";
require_once "funciones.php";

// Este archivo se crea como alternativa al resumen.php para en el caso que se decida 
// enviar todos los datos por la URL desde procesar.php, algo, que, según que datos se //envíen es más o menos recomendable

// Recuperar los datos enviados por URL
$codigo = $_GET["codigo"];
$unidades = $_GET["unidades"];
$tipoCliente = $_GET["tipoCliente"];

$subtotal = $_GET["subtotal"];
$descuento = $_GET["descuento"];
$total = $_GET["total"];

// Buscar el producto para obtener su nombre
$producto = buscarProducto($productos, $codigo);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Resumen del pedido</title>
</head>

<body>

    <h1>Resumen del pedido</h1>

    <p>
        <strong>Producto:</strong>
        <?php echo htmlspecialchars($producto["nombre"]); ?>
    </p>

    <p>
        <strong>Precio:</strong>
        <?php echo number_format($producto["precio"], 2, ",", "."); ?> €
    </p>

    <p>
        <strong>Unidades:</strong>
        <?php echo $unidades; ?>
    </p>

    <p>
        <strong>Tipo de cliente:</strong>
        <?php echo htmlspecialchars($tipoCliente); ?>
    </p>

    <hr>

    <p>
        <strong>Subtotal:</strong>
        <?php echo number_format($subtotal, 2, ",", "."); ?> €
    </p>

    <p>
        <strong>Descuento:</strong>
        <?php echo number_format($descuento, 2, ",", "."); ?> €
    </p>

    <h2>
        Total:
        <?php echo number_format($total, 2, ",", "."); ?> €
    </h2>

    <a href="index.php">Volver a la tienda</a>

</body>
</html>