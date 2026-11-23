<?php
$username = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');

    if (!empty($nombre) && !empty($apellido)) {
        // Tomamos la primera letra del nombre
        $primera_letra = substr($nombre, 0, 1);
        // Tomamos las primeras 4 letras del apellido
        $bloque_apellido = substr($apellido, 0, 4);
        
        // Unimos todo, lo pasamos a minúsculas y añadimos un número aleatorio
        $sugerencia = $primera_letra . $bloque_apellido . rand(10, 99);
        $username = strtolower($sugerencia);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ejercicio 2</title></head>
<body>
    <h1>Generador de Username Corporativo</h1>
    <form method="POST">
        <input type="text" name="nombre" placeholder="Nombre" required><br><br>
        <input type="text" name="apellido" placeholder="Apellido" required><br><br>
        <button type="submit">Generar Usuario</button>
    </form>

    <?php if ($username): ?>
        <h3>Tu usuario asignado es: <?php echo $username; ?></h3>
    <?php endif; ?>
</body>
</html>