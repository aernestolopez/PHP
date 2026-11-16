<?php 
session_start();
require_once 'session_calcular_iva.php';
/* Muy parecido a require sólo que si hay otra llamada al mismo archivo más adelante, la ignora */
$producto_guardado = "";


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
        $nuevo_producto = [
            'id' => $numero_item,
            'nombre' => $nombre,
            'precio_final' => $precio_final
        ];
        $_SESSION['productos'][] = $nuevo_producto;

        $producto_guardado = "Producto con número #$numero_item añadido correctamente";
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
<form action="session_index.php" method="POST">
<label> Nombre del producto: </label>
<input type="text" name="nombre_producto" required><br><br>
<label> Precio (€): </label>
<input type="number" step="0.01" name= "precio_producto" required><br><br>
<button type="submit">Calcular y guardar</button>
	</form>

	<?php if (!empty($_SESSION["productos"])){ ?>
    <h3> Resultado del servidor </h3>
    <p><?php echo $producto_guardado; ?></p>
	<?php } ?>

<!--Para que PHP entienda una etiqueta HTML sin necesidad de cerrar y abrir el bloque ?php, esa etiqueta tiene que estar dentro de una cadena de texto (un string) y acompañada de una instrucción que la muestre en pantalla, como por ejemplo echo o print -->

<?php
    $usuario = "Ana";
    $_SESSION["usuario"][] = $usuario;
    echo "<div class='tarjeta'>";
    echo "<h2>Hola, ". $_SESSION["usuario"][0] . " </h2>";
    echo "</div>";
?>
<?php if (!empty($_SESSION['productos'])): ?>
	<h2>Productos en el carrito</h2>
	<table border="1" cellpadding="5" cellspacing="0">
		<thead>
			<tr>
				<th>#</th>
				<th>Producto</th>
				<th>Precio con IVA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION['productos'] as $prod): ?>
				<tr>
					<td><?php echo $prod['id']; ?></td>
					<td><?php echo $prod['nombre']; ?></td>
					<td><?php echo $prod['precio_final']; ?> €</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

<?php
if(!empty($_SESSION["productos"])){


echo "El usuario " . $_SESSION["usuario"][0] . " tiene " . count($_SESSION["productos"]) . " productos";
}
?>

</body>
</html>