<?php  
require_once 'calcular_iva.php';
/* Muy parecido a require sólo que si hay otra llamada al mismo archivo más adelante, la ignora */
$producto_guardado = "";
$precio_final = 0;
$numero_item = 0;
if($_SERVER["REQUEST_METHOD"] == "POST")

{
	/* Esta función convierte caracteres especiales en entidades HTML.
	Es una medida de seguridad para evitar ataques cuando se usan formularios. Neutralizar texto que pueda contener código malicioso
	No usarla nunca antes de guardar datos en la BBDD
	*/ 
	$nombre = htmlspecialchars($_POST['nombre_producto'] ?? '');
	
	/*Operador ??: Evalúa si la variable de la izquierda existe y es distinto de NULL. En caso contrario toma como valor el que se le ponga a la derecha */
	//Su equivalencia con if es la siguiente:
	/*if (isset($_POST['nombre_producto'])) {
    $nombre = $_POST['nombre_producto'];
	} else {
    $nombre = '';
	}
*/
	$precio = (float)($_POST['precio_producto'] ?? 0);
	if(!empty($nombre) && $precio > 0)
	{
		$numero_item = contadorProductos();
		$precio_final = calcularPrecioConIva($precio);
		$producto_guardado = "Producto #$numero_item añadido: $nombre - Total con IVA: $precio_final €";
	} else {
		$producto_guardado = "Por favor rellene los campos correctamente";
	}
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mi tienda PHP</title>
</head>
<body>
<h1> Añadir producto</h1>
<form action="index.php" method="POST">
<label> Nombre del producto: </label>
<input type="text" name="nombre_producto" required><br><br>
<label> Precio (€): </label>
<input type="number" step="0.01" name= "precio_producto" required><br><br>
<button type="submit">Calcular y guardar</button>
	</form>

<!--Al mezclar php y html se recomienda: En lugar de abrir y cerrar llaves, se utilizan : para iniciar una estructura y etiquetas de cierre explícitas como endif; endforeach; endwhile;  -->
	<?php if (!empty($producto_guardado)): ?>
    <h3> Resultado del servidor </h3>
    <p><?php echo $producto_guardado; ?></p>
<?php endif; ?>

<!--	<?php if (!empty($producto_guardado)){ ?>

    <h3> Resultado del servidor </h3>
    <p><?php echo $producto_guardado; ?></p>
	<?php } ?> -->

<!--Para que PHP entienda una etiqueta HTML sin necesidad de cerrar y abrir el bloque ?php, esa etiqueta tiene que estar dentro de una cadena de texto (un string) y acompañada de una instrucción que la muestre en pantalla, como por ejemplo echo o print -->

<!-- Opcion 1 
<?php
    $usuario = "Ana";
    echo "<div class='tarjeta'>";
    echo "<h2>Hola, $usuario</h2>";
    echo "</div>";
?>

-->

<!-- Opción 2

<?php $usuario = "Ana"; ?>

<div class="tarjeta">
    <h2>Hola, <?php echo $usuario; ?></h2>
</div>

 -->

</body>
</html>