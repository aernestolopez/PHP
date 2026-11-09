<?php
require_once("datos.php");
require_once("funciones.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <h1>Tienda Online</h1>
    <br>
    <h2>Catálogo de productos</h2>
    <br>

        <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Código</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $datos): ?>
                <tr>    
                    <td><?php echo $datos["codigo"]; ?></td>
                    <td><?php echo $datos["producto"]; ?></td>
                    <td><?php echo $datos["precio"]." €"; ?></td>
                    <td><?php echo $datos["stock"]; ?></td>
                    <td><?php echo $datos["categoria"]; ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
        </table>
        <br>
        <br>

        <form action="procesar.php" method="POST">
            <label>Producto</label>
            <select name="selectProducto" required>
                <option>Elige un producto</option>
                <?php foreach ($productos as $datos): ?>
                <option value="<?php echo $datos["codigo"]; ?>"><?php echo $datos["producto"]; ?> </option>
                <?php endforeach; ?>
            </select>
            <br>
            <br>
            <label>Cantidad</label>
            <input type="number" min="1" default="1" name="cantidad" required>
            <br>
            <br>
            <label>Tipo usuario</label>
            <select name="tipoUsuario" required>
                <option value="normal">Cliente normal</option>
                <option value="premium">Cliente premium</option>
            </select>
            <br> <br>
            <button type="submit" value="enviar">Enviar</button>
        </form>
</body>
</html>