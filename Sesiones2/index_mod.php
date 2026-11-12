<?php  
session_start(); // Esencial para recordar el array entre recargas

require_once 'calcular_iva_mod.php';

$producto_guardado = "";
   
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	$nombre = htmlspecialchars($_POST['nombre_producto'] ?? '');
	$precio = (float)($_POST['precio_producto'] ?? 0);
    
	if(!empty($nombre) && $precio > 0)
	{
		$numero_item = contadorProductos();
		$precio_final = calcularPrecioConIva($precio);
		
		// Creamos un array con los datos del producto actual y que irá almacenando cada // producto añadido
		$nuevo_producto = [
			'id' => $numero_item,
			'nombre' => $nombre,
			'precio_final' => $precio_final
		];
		
		// Guardamos el producto dentro del array global de la sesión
		// En el carrito completo meto cada artículo individual
		$_SESSION['lista_productos'][] = $nuevo_producto;

		$producto_guardado = "Producto #$numero_item añadido con éxito.";
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
	<style>
		table { width: 50%; border-collapse: collapse; margin-top: 20px; }
		th, td { border: 1px solid #000; padding: 8px; text-align: left; }
		th { background-color: #f2f2f2; }
	</style>
</head>
<body>

<h1> Añadir producto</h1>
<form action="index_mod.php" method="POST">
	<label> Nombre del producto: </label>
	<input type="text" name="nombre_producto" required><br><br>
	<label> Precio (€): </label>
	<input type="number" step="0.01" name="precio_producto" required><br><br>
	<button type="submit">Calcular y guardar</button>
</form>

<?php if (!empty($producto_guardado)): ?>
    <h3> Resultado del servidor </h3>
    <p><?php echo $producto_guardado; ?></p>
<?php endif; ?>

<!-- SECCIÓN NUEVA: Mostrar la lista completa de productos -->
<?php if (!empty($_SESSION['lista_productos'])): ?>
	<h2>Productos en el carrito</h2>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>Producto</th>
				<th>Precio con IVA</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($_SESSION['lista_productos'] as $prod): ?>
				<tr>
					<td><?php echo $prod['id']; ?></td>
					<td><?php echo $prod['nombre']; ?></td>
					<td><?php echo $prod['precio_final']; ?> €</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>

</body>
</html>