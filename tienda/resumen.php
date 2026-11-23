
<?php
require_once "datos.php";
require_once "funciones.php";

// Comprobar que llegan todos los datos necesarios
if (
    !isset($_GET["codigo"]) ||
    !isset($_GET["unidades"]) ||
    !isset($_GET["tipoCliente"]) ||
    !is_string($_GET["codigo"]) ||
    !is_string($_GET["unidades"]) ||
    !is_string($_GET["tipoCliente"])
) {
    $mensaje = "Faltan datos necesarios para mostrar el resumen";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// Recoger y normalizar los datos
$codigo = strtoupper(trim($_GET["codigo"]));
$unidadesTexto = trim($_GET["unidades"]);
$tipoCliente = strtolower(trim($_GET["tipoCliente"]));

// Validar las unidades
if (!validarUnidades($unidadesTexto)) {
    $mensaje = "Las unidades deben ser un entero positivo";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

$unidades = (int)$unidadesTexto;

// Validar el tipo de cliente
if ($tipoCliente !== "normal" && $tipoCliente !== "premium") {
    $mensaje = "El tipo de cliente no es válido";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// Buscar el producto. Para mostrarlo en la primera parte del resumen
$producto = buscarProducto($productos, $codigo);

if ($producto === null) {
    $mensaje = "El producto seleccionado no existe";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// Comprobar el stock
if (!comprobarStock($producto, $unidades)) {
    $mensaje = "No hay existencias suficientes";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// Calcular el pedido
$pedido = procesarPedido($producto, $unidades, $tipoCliente);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen del pedido</title>
</head>
<body>

<h1>Resumen del pedido</h1>

<h2>Datos del producto</h2>

<p>
    <strong>Código:</strong>
    <?= htmlspecialchars($producto["codigo"]) ?>
</p>

<p>
    <strong>Producto:</strong>
    <?= htmlspecialchars($producto["nombre"]) ?>
</p>

<p>
    <strong>Precio unitario:</strong>
    <?= number_format($producto["precio"], 2, ",", ".") ?> €
</p>

<p>
    <strong>Unidades:</strong>
    <?php echo $unidades; ?> <!-- <?= $unidades ?> --> 
</p>

<p>
    <strong>Tipo de cliente:</strong>
    <?php echo htmlspecialchars($tipoCliente); ?>
    <!-- <?= htmlspecialchars($tipoCliente) ?> -->
</p>

<h2>Importe del pedido</h2>

<p>
    <strong>Subtotal:</strong>
    <!--<?= number_format($pedido["subtotal"], 2, ",", ".") ?> € -->
    <?php echo $pedido["subtotal"] . "€";?>
</p>

<p>
    <strong>Descuento:</strong>
    <!-- 2 decimales, con una , como separador decimal y un . como separador de miles -->
    <?= number_format($pedido["descuento"], 2, ",", ".") ?> €
</p>

<p>
    <strong>Total a pagar:</strong>
    <?= number_format($pedido["total"], 2, ",", ".") ?> €
</p>

<p>
    <a href="index.php">Volver a la tienda</a>
</p>

</body>
</html>
