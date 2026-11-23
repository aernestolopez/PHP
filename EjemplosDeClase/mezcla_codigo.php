<?php 
// Definimos una variable de ejemplo
$usuario_logeado = true; 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo PHP y HTML</title>
</head>
<body>

    <!-- Uso de la sintaxis alternativa con ":" y "endif;" -->
    <?php if ($usuario_logeado): ?>
        <h1>¡Bienvenido de nuevo a tu panel!</h1>
        <p>Aquí tienes tus notificaciones.</p>
    <?php else: ?>
        <h1>Por favor, inicia sesión</h1>
        <button>Iniciar Sesión</button>
    <?php endif; ?>


<!-- Ejemplo con bucles foreach -->
<?php 
$frutas = ['Manzana', 'Banana', 'Naranja', 'Uva']; 
?>

<ul>
    <?php foreach ($frutas as $fruta): ?>
        <li>El nombre de la fruta es: <?php echo $fruta; ?></li>
    <?php endforeach; ?>
</ul>

<!-- También puedes escribir etiquetas HTML directamente dentro de cadenas de texto de PHP usando la instrucción echo o print. Sin embargo, no se recomienda para estructuras grandes -->

<?php echo "<p>Este texto se generó desde PHP.</p>"; ?>

</body>
</html>