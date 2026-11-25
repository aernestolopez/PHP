<?php
session_start();

if (!isset($_SESSION['notas_materia'])) {
    $_SESSION['notas_materia'] = [];
}

$mensaje = "";
$error = "";

try {
    // 1. Vaciar la tabla
    if (isset($_POST['vaciar'])) {
        $_SESSION['notas_materia'] = [];
        $mensaje = "La tabla ha sido vaciada correctamente.";
    }

    // 2. Añadir alumno de forma secuencial (sin ordenar)
    if (isset($_POST['anadir'])) {
        $nombre = trim($_POST['nombre'] ?? '');
        $apellidos = trim($_POST['apellidos'] ?? '');

        if (empty($nombre) || empty($apellidos)) {
            throw new Exception("Debes rellenar tanto el nombre como los apellidos del alumno.");
        }

        // Comprobar si el alumno ya existe recorriendo el array secuencial
        foreach ($_SESSION['notas_materia'] as $registro) {
            if (strcasecmp($registro['nombre'], $nombre) === 0 && strcasecmp($registro['apellidos'], $apellidos) === 0) {
                throw new Exception("El alumno '{$nombre} {$apellidos}' ya está registrado.");
            }
        }

        // Generar nota aleatoria entre 4 y 8
        $calificacion = random_int(4, 8);

        // Añadir al final del array (orden de llegada)
        $_SESSION['notas_materia'][] = [
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'nota' => $calificacion
        ];

        $mensaje = "Alumno añadido: {$nombre} {$apellidos} (Nota: {$calificacion}).";
    }

    // 3. Ordenar de mayor a menor usando usort
    if (isset($_POST['ordenar'])) {
        if (empty($_SESSION['notas_materia'])) {
            throw new Exception("No hay alumnos en la tabla para ordenar.");
        }

        // usort ordena el array según la función de comparación personalizada
        // $b['nota'] <=> $a['nota'] ordena de mayor a menor
        $ordenado = usort($_SESSION['notas_materia'], function ($a, $b) {
            return $b['nota'] <=> $a['nota'];
        });

        if (!$ordenado) {
            throw new Exception("Ocurrió un error al intentar ordenar las calificaciones.");
        }

        $mensaje = "Calificaciones ordenadas de mayor a menor.";
    }

} catch (Throwable $e) {
    $error = $e->getMessage();
}

$total_actual = count($_SESSION['notas_materia']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Calificaciones en PHP</title>
</head>
<body>

    <h2>Registro de Calificaciones</h2>
    <p><strong>Alumnos registrados:</strong> <?= $total_actual ?></p>

    <?php if ($mensaje): ?>
        <p><strong>Aviso:</strong> <?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <?php if ($error): ?>
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre">
        </p>
        <p>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos">
        </p>
        <p>
            <button type="submit" name="anadir">Añadir Alumno</button>
            <button type="submit" name="ordenar">Ordenar de Mayor a Menor</button>
            <button type="submit" name="vaciar">Vaciar Tabla</button>
        </p>
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($_SESSION['notas_materia'])): ?>
                <?php foreach ($_SESSION['notas_materia'] as $indice => $alumno): ?>
                    <tr>
                        <td><?= $indice + 1 ?></td>
                        <td><?= htmlspecialchars($alumno['nombre']) ?></td>
                        <td><?= htmlspecialchars($alumno['apellidos']) ?></td>
                        <td><?= $alumno['nota'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">La tabla está vacía. Introduce un alumno para asignarle su nota.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
