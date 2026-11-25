<?php
session_start();
require_once 'funciones.php';

$equipos = ['FC Barcelona', 'Real Madrid', 'Atlético de Madrid', 'Real Betis Balompié', 'Sevilla FC', 'Valencia FC'];

// 1. Primera vez: cargamos los 3 partidos de ejemplo
if (!isset($_SESSION['partidos'])) {
    $_SESSION['partidos'] = partidosIniciales();
}

$error = '';

// 2. Procesar peticiones POST (cada botón tiene su propio 'name')
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Botón: Mostrar clasificación original (destruye la sesión; al recargar se vuelven a cargar los 3 partidos)
    if (isset($_POST['original'])) {
        session_destroy();
        $mensaje = "Clasificación original restaurada.";
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit;
    }

    // Botón: Vaciar puntos
    if (isset($_POST['vaciar'])) {
        $_SESSION['partidos'] = [];
        $mensaje = "Puntos vaciados.";
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit;
    }

    // Botón: Añadir partido
    if (isset($_POST['anadir'])) {
        $local = limpiarTexto($_POST['local'] ?? '');
        $golesLocal = limpiarTexto($_POST['golesLocal'] ?? '');
        $golesVisitante = limpiarTexto($_POST['golesVisitante'] ?? '');
        $visitante = limpiarTexto($_POST['visitante'] ?? '');

        try {
            validarPartido($equipos, $_SESSION['partidos'], $local, $golesLocal, $visitante, $golesVisitante);

            $_SESSION['partidos'][] = [
                'local' => $local,
                'golesLocal' => (int) $golesLocal,
                'visitante' => $visitante,
                'golesVisitante' => (int) $golesVisitante
            ];
            $mensaje = "Partido añadido: $local $golesLocal - $golesVisitante $visitante";
            header("Location: index.php?mensaje=" . urlencode($mensaje));
            exit;
        } catch (Exception $excepcion) {
            // Los errores se muestran sin redirigir
            $error = $excepcion->getMessage();
        }
    }
}

// 3. Mensaje de que todo ha ido bien (llega por la URL tras la redirección)
$mensajeOk = $_GET['mensaje'] ?? '';

$clasificacion = calcularClasificacion($equipos, $_SESSION['partidos']);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación de la Liga</title>
</head>

<body>
    <h1>Clasificación de la Liga</h1>

    <?php if ($error !== ''): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <?php if ($mensajeOk !== ''): ?>
        <p style="color: green;"><?= htmlspecialchars($mensajeOk) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <button type="submit" name="original">Mostrar clasificación original</button>
        <button type="submit" name="vaciar">Vaciar puntos</button>
    </form>

    <hr>

    <form method="POST" action="index.php">
        <select name="local">
            <?php foreach ($equipos as $equipo): ?>
                <option value="<?= htmlspecialchars($equipo) ?>"><?= htmlspecialchars($equipo) ?></option>
            <?php endforeach; ?>
        </select>

        <label>
            Goles
            <input type="number" name="golesLocal">
        </label>

        <label>
            Goles
            <input type="number" name="golesVisitante">
        </label>

        <select name="visitante">
            <?php foreach ($equipos as $equipo): ?>
                <option value="<?= htmlspecialchars($equipo) ?>"><?= htmlspecialchars($equipo) ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" name="anadir">Añadir partido</button>
    </form>

    <hr>

    <table border="1">
        <tr>
            <th>Posición</th>
            <th>Equipo</th>
            <th>Puntos</th>
            <th>Goles a favor</th>
        </tr>
        <?php foreach ($clasificacion as $indice => $fila): ?>
            <tr>
                <td><?= $indice + 1 ?></td>
                <td><?= htmlspecialchars($fila['equipo']) ?></td>
                <td><?= $fila['puntos'] ?></td>
                <td><?= $fila['golesFavor'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Partidos jugados</h2>
    <?php if (count($_SESSION['partidos']) === 0): ?>
        <p>No hay partidos jugados.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['partidos'] as $partido): ?>
                <li>
                    <?= htmlspecialchars($partido['local']) ?> <?= $partido['golesLocal'] ?>
                    - <?= $partido['golesVisitante'] ?> <?= htmlspecialchars($partido['visitante']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>

</html>
