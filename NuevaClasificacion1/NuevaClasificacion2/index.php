<?php
session_start();

// Función para cargar los datos iniciales (6 equipos y 3 partidos)
function inicializarLiga() {
    $_SESSION['equipos'] = [
        'Real Madrid'      => ['puntos' => 0, 'gf' => 0],
        'FC Barcelona'     => ['puntos' => 0, 'gf' => 0],
        'Atlético Madrid'  => ['puntos' => 0, 'gf' => 0],
        'Athletic Club'    => ['puntos' => 0, 'gf' => 0],
        'Real Sociedad'    => ['puntos' => 0, 'gf' => 0],
        'Real Betis'       => ['puntos' => 0, 'gf' => 0]
    ];

    // Reiniciamos también el historial de partidos
    $_SESSION['partidos'] = [];

    $partidosIniciales = [
        ['local' => 'Real Madrid',     'goles_local' => 2, 'visitante' => 'FC Barcelona',  'goles_visitante' => 1],
        ['local' => 'Atlético Madrid', 'goles_local' => 1, 'visitante' => 'Athletic Club', 'goles_visitante' => 1],
        ['local' => 'Real Sociedad',   'goles_local' => 0, 'visitante' => 'Real Betis',    'goles_visitante' => 3]
    ];

    foreach ($partidosIniciales as $partido) {
        procesarPartido($partido['local'], $partido['goles_local'], $partido['visitante'], $partido['goles_visitante']);
    }
}

// Función para validar y actualizar puntos, goles e historial lanzando excepciones si hay errores
function procesarPartido($local, $golesLocal, $visitante, $golesVisitante) {
    // 1. Validar que los equipos existan en la sesión
    if (!isset($_SESSION['equipos'][$local]) || !isset($_SESSION['equipos'][$visitante])) {
        throw new Exception("Uno o ambos equipos seleccionados no existen en la liga.");
    }

    // 2. Validar que no juegue contra sí mismo
    if ($local === $visitante) {
        throw new Exception("Un equipo no puede jugar un partido contra sí mismo.");
    }

    // 3. Validar que los goles sean valores numéricos válidos y no negativos
    if ($golesLocal === '' || $golesVisitante === '' || !is_numeric($golesLocal) || !is_numeric($golesVisitante)) {
        throw new Exception("Debes introducir una cantidad válida de goles.");
    }

    $golesLocal = (int)$golesLocal;
    $golesVisitante = (int)$golesVisitante;

    if ($golesLocal < 0 || $golesVisitante < 0) {
        throw new Exception("Los goles no pueden ser números negativos.");
    }

    // Si todo es correcto, sumamos goles a favor
    $_SESSION['equipos'][$local]['gf'] += $golesLocal;
    $_SESSION['equipos'][$visitante]['gf'] += $golesVisitante;

    // Repartir puntos (3 victoria, 1 empate, 0 derrota)
    if ($golesLocal > $golesVisitante) {
        $_SESSION['equipos'][$local]['puntos'] += 3;
    } elseif ($golesVisitante > $golesLocal) {
        $_SESSION['equipos'][$visitante]['puntos'] += 3;
    } else {
        $_SESSION['equipos'][$local]['puntos'] += 1;
        $_SESSION['equipos'][$visitante]['puntos'] += 1;
    }

    // Guardamos el partido en el historial de la sesión
    $_SESSION['partidos'][] = [
        'local'           => $local,
        'goles_local'     => $golesLocal,
        'visitante'       => $visitante,
        'goles_visitante' => $golesVisitante
    ];
}

$mensajeError = '';
$mensajeExito = '';

try {
    // Si la sesión aún no existe, cargamos los datos iniciales
    if (!isset($_SESSION['equipos']) || !isset($_SESSION['partidos'])) {
        inicializarLiga();
    }

    // Procesamiento de los formularios (POST)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Botón 1: Añadir resultado de partido
        if (isset($_POST['btn_agregar'])) {
            $local = $_POST['local'] ?? '';
            $visitante = $_POST['visitante'] ?? '';
            $golesLocal = $_POST['goles_local'] ?? '';
            $golesVisitante = $_POST['goles_visitante'] ?? '';

            procesarPartido($local, $golesLocal, $visitante, $golesVisitante);
            $mensajeExito = "Resultado añadido correctamente ($local $golesLocal - $golesVisitante $visitante).";
        }

        // Botón 2: Reiniciar a los equipos y 3 resultados iniciales
        if (isset($_POST['btn_reiniciar'])) {
            inicializarLiga();
            $mensajeExito = "La clasificación y el historial se han reiniciado a los datos iniciales.";
        }

        // Botón 3: Borrar todos los resultados (dejar los 6 equipos a 0 y vaciar historial)
        if (isset($_POST['btn_borrar'])) {
            if (empty($_SESSION['equipos'])) {
                throw new Exception("No hay equipos cargados para borrar sus resultados.");
            }
            foreach ($_SESSION['equipos'] as $nombre => $datos) {
                $_SESSION['equipos'][$nombre] = ['puntos' => 0, 'gf' => 0];
            }
            $_SESSION['partidos'] = [];
            $mensajeExito = "Se han borrado todos los resultados y el historial. Todos los equipos están a 0.";
        }
    }
} catch (Exception $e) {
    $mensajeError = "Error: " . $e->getMessage();
}

// Preparar el array para ordenarlo con usort sin perder el nombre del equipo
$clasificacion = [];
if (isset($_SESSION['equipos'])) {
    foreach ($_SESSION['equipos'] as $nombre => $datos) {
        $clasificacion[] = [
            'nombre' => $nombre,
            'puntos' => $datos['puntos'],
            'gf'     => $datos['gf']
        ];
    }

    // Ordenación mediante usort: 1º por puntos (desc), 2º por goles a favor (desc)
    usort($clasificacion, function($a, $b) {
        if ($a['puntos'] === $b['puntos']) {
            return $b['gf'] <=> $a['gf'];
        }
        return $b['puntos'] <=> $a['puntos'];
    });
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clasificación de la Liga</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 30px auto; padding: 0 15px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background-color: #2c3e50; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .form-box { background: #f4f4f4; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .form-row { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-bottom: 10px; }
        input[type="number"] { width: 60px; padding: 5px; }
        select, button { padding: 7px 12px; cursor: pointer; }
        .alerta { padding: 10px; border-radius: 4px; margin-bottom: 15px; font-weight: bold; }
        .error { background-color: #fadbd8; color: #c0392b; border: 1px solid #c0392b; }
        .exito { background-color: #d4efdf; color: #1e8449; border: 1px solid #1e8449; }
        .btn-danger { background-color: #e74c3c; color: white; border: none; }
        .btn-warning { background-color: #f39c12; color: white; border: none; }
        .btn-primary { background-color: #27ae60; color: white; border: none; }
        .marcador { font-weight: bold; background-color: #ecf0f1; }
    </style>
</head>
<body>

    <h2>Añadir Resultado de Partido</h2>

    <?php if ($mensajeError): ?>
        <div class="alerta error"><?= htmlspecialchars($mensajeError) ?></div>
    <?php endif; ?>

    <?php if ($mensajeExito): ?>
        <div class="alerta exito"><?= htmlspecialchars($mensajeExito) ?></div>
    <?php endif; ?>

    <div class="form-box">
        <form method="POST" novalidate>
            <div class="form-row">
                <label>Local:</label>
                <select name="local">
                    <?php foreach (array_keys($_SESSION['equipos']) as $equipo): ?>
                        <option value="<?= htmlspecialchars($equipo) ?>"><?= htmlspecialchars($equipo) ?></option>
                    <?php endforeach; ?>
                </select>

                <input type="number" name="goles_local" min="0" value="0">
                <span>-</span>
                <input type="number" name="goles_visitante" min="0" value="0">

                <label>Visitante:</label>
                <select name="visitante">
                    <?php foreach (array_keys($_SESSION['equipos']) as $equipo): ?>
                        <option value="<?= htmlspecialchars($equipo) ?>"><?= htmlspecialchars($equipo) ?></option>
                    <?php endforeach; ?>
                </select>

                <button type="submit" name="btn_agregar" class="btn-primary">Añadir Resultado</button>
            </div>
        </form>

        <form method="POST" style="margin-top: 15px; border-top: 1px solid #ddd; padding-top: 10px;">
            <button type="submit" name="btn_reiniciar" class="btn-warning">Reiniciar a datos iniciales</button>
            <button type="submit" name="btn_borrar" class="btn-danger">Borrar todos los resultados</button>
        </form>
    </div>

    <h2>Tabla de Clasificación</h2>
    <table>
        <thead>
            <tr>
                <th>Posición</th>
                <th>Equipo</th>
                <th>Puntos</th>
                <th>Goles a Favor</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clasificacion as $indice => $equipo): ?>
                <tr>
                    <td><?= $indice + 1 ?>º</td>
                    <td style="text-align: left; font-weight: bold;"><?= htmlspecialchars($equipo['nombre']) ?></td>
                    <td><?= $equipo['puntos'] ?></td>
                    <td><?= $equipo['gf'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Historial de Partidos Jugados</h2>
    <?php if (empty($_SESSION['partidos'])): ?>
        <p>No hay partidos registrados todavía.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Equipo Local</th>
                    <th>Resultado</th>
                    <th>Equipo Visitante</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['partidos'] as $index => $partido): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td style="text-align: right;"><?= htmlspecialchars($partido['local']) ?></td>
                        <td class="marcador"><?= $partido['goles_local'] ?> - <?= $partido['goles_visitante'] ?></td>
                        <td style="text-align: left;"><?= htmlspecialchars($partido['visitante']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>
