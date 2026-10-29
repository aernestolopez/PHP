<?php
$clasificacion = [
    1 => "Barcelona",
    2 => "Real Madrid",
    3 => "Atlético de Madrid",
    4 => "Villarreal",
    5 => "Athletic Club",
    6 => "Betis"
];

$busqueda_nombre = isset($_GET['nombre']) ? trim($_GET['nombre']) : '';
$busqueda_posición = isset($_GET['posicion']) ? trim($_GET['posicion']) : '';

$resultados = $clasificacion;

if ($busqueda_nombre !== '' || $busqueda_posición !== '') {
    $resultados = [];
    foreach ($clasificacion as $posicion => $equipo) {
        $coincide_nombre = true;
        $coincide_posicion = true;

        
        if ($busqueda_nombre !== '') {
            $coincide_nombre = str_contains(strtolower($equipo), strtolower($busqueda_nombre));
        }

    
        if ($busqueda_posición !== '') {
            $coincide_posicion = ($posicion == (int)$busqueda_posición);
        }

       
        if ($coincide_nombre && $coincide_posicion) {
            $resultados[$posicion] = $equipo;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación</title>
</head>
<body>
    <form method="GET" action="">
        <label>Buscar por nombre:</label>
        <input type="text" name="nombre" value="<?php echo htmlspecialchars($busqueda_nombre); ?>" placeholder="Ej. Betis">
        
        <label>Buscar por posición:</label>
        <input type="number" name="posicion" value="<?php echo htmlspecialchars($busqueda_posición); ?>" min="1" placeholder="Ej. 3">
        
        <button type="submit">Buscar</button>
        <a href="?">Reiniciar</a>
    </form>
    <br>

    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Posición</th>
                <th>Equipo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($resultados)): ?>
                <?php foreach ($resultados as $posicion => $equipo): ?>
                    <tr>
                        <td><?php echo $posicion; ?></td>
                        <td><?php echo htmlspecialchars($equipo); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="2">Sin resultados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>