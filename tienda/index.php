
<?php
//A diferencia de require, con require_once, el archivo se incluye una única vez
require_once "datos.php";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tienda online</title>
</head>
<body>

    <h1>Tienda online</h1>

    <h2>Catálogo de productos</h2>

    <table border="1" cellpadding="8">
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
            <tr>
                <td>P001</td>
                <td>Teclado mecánico</td>
                <td>45,90 €</td>
                <td>10</td>
                <td>Periféricos</td>
            </tr>

            <tr>
                <td>P002</td>
                <td>Ratón inalámbrico</td>
                <td>19,95 €</td>
                <td>15</td>
                <td>Periféricos</td>
            </tr>

            <tr>
                <td>P003</td>
                <td>Monitor 24 pulgadas</td>
                <td>149,90 €</td>
                <td>5</td>
                <td>Monitores</td>
            </tr>

            <tr>
                <td>P004</td>
                <td>Webcam HD</td>
                <td>35,50 €</td>
                <td>0</td>
                <td>Accesorios</td>
            </tr>
        </tbody>
    </table>

    <h2>Realizar pedido</h2>

    <form action="procesar.php" method="post">

        <label for="codigo">Producto:</label>
<!-- Los atributos value almacenan el valor a enviar a PHP, es decir, la opción elegida por el usuario -->
        <select name="codigo" required>
            <option value="">Selecciona un producto</option>
            <option value="P001">Teclado mecánico - 45,90 €</option>
            <option value="P002">Ratón inalámbrico - 19,95 €</option>
            <option value="P003">Monitor 24 pulgadas - 149,90 €</option>
            <option value="P004">Webcam HD - 35,50 € (Sin stock)</option>
        </select>

        <br><br>

        <label for="unidades">Unidades:</label>
        <!-- No ponemos aquí require para ver la diferencia al ejecutarlo respecto al código de producto o tipo de cliente -->
        <input type="number" name="unidades" min="1" 
        >

        <br><br>

        <label for="tipoCliente">Tipo de cliente:</label>

        <select name="tipoCliente" required>
            <option value="" selected>Tipo cliente</option>
            <option value="normal">Normal</option>
            <option value="premium">Premium (10 % de descuento)</option>
        </select>

        <br><br>

        <!--<button type="submit">Confirmar pedido</button>-->
        <input type="submit" name="Confirmar" value="Confirmar pedido">

    </form>

</body>
</html>
