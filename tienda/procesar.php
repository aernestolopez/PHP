
<?php

require_once "datos.php";
require_once "funciones.php";

// 1. Comprobamos que el formulario se ha enviado mediante POST.
// Opción B: if (!isset($_POST["Confirmar"]))
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    $mensaje = "Método de acceso no permitido";
    // Si intentáramos escribir "mensaje=urlencode($mensaje)", PHP //escribiría la palabra "urlencode" literalmente en la URL
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// 2. Comprobamos que los campos no están vacíos 
// Si no existe y no tiene valor NULL pondría !isset
//Los campos que se envian por POST, se reciben como cadenas, aunque sean datos numéricos
if (
    empty($_POST["codigo"]) || //!isset($_POST["codigo"])  
    empty($_POST["unidades"]) ||
    empty($_POST["tipoCliente"]))
 {
    $mensaje = "Faltan datos en el formulario";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// 3. Recogemos y limpiamos los datos.
$codigo = strtoupper(trim($_POST["codigo"]));
$unidadesTexto = trim($_POST["unidades"]);
$tipoCliente = strtolower(trim($_POST["tipoCliente"]));

// 4. Validamos las unidades.
if (!validarUnidades($unidadesTexto)) {
    $mensaje = "Las unidades deben ser un entero positivo";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

$unidades = (int)$unidadesTexto;

// 5. Validamos el tipo de cliente. Comprobamos que el tipo de cliente no //sea ni normal ni premium
if (
    $tipoCliente !== "normal" &&
    $tipoCliente !== "premium"
) {
    $mensaje = "El tipo de cliente no es válido";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// 6. Buscamos el producto por su código.
$producto = buscarProducto($productos, $codigo);

if ($producto === null) {
    $mensaje = "El producto seleccionado no existe";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// 7. Comprobamos si hay stock suficiente.
if (!comprobarStock($producto, $unidades)) {
    $mensaje = "No hay existencias suficientes";
    header("Location: error.php?mensaje=" . urlencode($mensaje));
    exit;
}

// 8. Si todo es correcto, vamos al resumen del pedido.
// ? Indica el comienzo de los parámetros de la URL
// & Separa un parámetro del siguiente. (Normativa de URLs)
// = Asigna un valor a cada parámetro
// Todo entre comillas porque el resultado final debe ser una cadena de //texto con sucesivas concatenaciones



header(
    "Location: resumen.php?codigo=" . urlencode($codigo) .
    "&unidades=" . urlencode($unidades) .
    "&tipoCliente=" . urlencode($tipoCliente)
);


/* header(
    "Location: resumen.php?codigo=" . urlencode($codigo) .
    "&unidades=" . $unidades .
    "&tipoCliente=" . urlencode($tipoCliente) .
    "&subtotal=" . $pedido["subtotal"] .
    "&descuento=" . $pedido["descuento"] .
    "&total=" . $pedido["total"]
); */

/* Podríamos enviar también nombre y precio por la URL y en resumen recoger los datos, pero no es recomendable envíar ciertos tipos de datos por la URL porque el usuario podría modificarlos */

exit;
