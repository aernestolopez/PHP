<?php
session_start();
require_once 'funciones.php';

var_dump($_SESSION['tareas']);
echo $_SESSION["tareas"][0];
echo $_SESSION["tareas"][1];
echo $_SESSION["tareas"][2];

// 1. Inicializar la lista de tareas en sesión si no existe
if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [
        'Repasar PHP',
        'Hacer ejercicio de sesiones',
        'Estudiar arrays'
    ];
}


$error = '';

// 2. Procesar peticiones POST (cada botón tiene su propio 'name')
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Botón: Vaciar toda la lista
    if (isset($_POST['borrar_todo'])) {
        $_SESSION['tareas'] = [];
        header('Location: index.php');
        exit;
    }

    // Botón: Eliminar una tarea concreta. Si el usuario ha pulsado botón eliminar
    if (isset($_POST['eliminar'])) {
        //El botón eliminar envía un valor (el especificado en atributo value que se usa para eliminar dicho elemento)
        $indice = (int) ($_POST['eliminar']);
        if (isset($_SESSION['tareas'][$indice])) {
            unset($_SESSION['tareas'][$indice]);
            // Renumera los índices para tapar el hueco
            $_SESSION['tareas'] = array_values($_SESSION['tareas']);
        }

        header('Location: index.php');
        exit;
    }

    // Botón: Añadir nueva tarea
    if (isset($_POST['agregar'])) {
        $nuevaTarea = limpiarTexto($_POST['tarea'] ?? '');

        if ($nuevaTarea === '') {
            $error = 'Debes escribir una tarea antes de añadirla.';
        } else {
            $_SESSION['tareas'][] = $nuevaTarea;
            // Si pongo $_SESSION['tareas'] = $nuevaTarea; sustituye todas las tareas que haya por el valor que tenga $nuevaTarea
            header('Location: index.php');
            exit;
        }
    }
}

// 3. Procesar búsqueda por GET (Uso GET porque es una operación de sólo lectura)
$busqueda = $_GET['buscar'] ?? '';
$tareasMostradas = filtrarTareas($_SESSION['tareas'], $busqueda);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>To-Do DAW</title>
</head>
<body>

    <h1>Lista de Tareas Pendientes</h1>

    <!-- Botón para vaciar toda la lista -->
    <form method="POST" action="index.php">
        <button type="submit" name="borrar_todo">Vaciar lista</button>
    </form>

    <hr>

    <!-- Formulario para añadir tarea (POST) -->
    <h2>Nueva Tarea</h2>

    <?php if ($error !== ''): ?>
        <p><strong>Error:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <label for="tarea">Tarea:</label>
        <input type="text" id="tarea" name="tarea">
        <button type="submit" name="agregar">Añadir</button>
    </form>

    <hr>

    <!-- Formulario buscador (GET) -->
    <h2>Tareas Actuales</h2>

    <form method="GET" action="index.php">
        <label for="buscar">Buscar:</label>
        <input type="text" id="buscar" name="buscar" value="<?= htmlspecialchars($busqueda) ?>">
        <button type="submit">Filtrar</button>
        <!--<?php if ($busqueda !== ''): ?>
            <button type="submit" name="buscar" value="">Ver todas</button>
        <?php endif; ?> -->
    </form>

    <br>

    <!-- Tabla de resultados -->
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Tarea</th>
            <th>Acción</th>
        </tr>

        <?php if (empty($tareasMostradas)): ?>
            <tr>
                <td colspan="3">No hay tareas que mostrar.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($tareasMostradas as $indice => $texto): ?>
                <tr>
                    <td><?= $indice + 1 ?></td>
                    <td><?= htmlspecialchars($texto) ?></td>
                    <td>
                        <form method="POST" action="index.php">
                            <!--<input type="hidden" name="indice" value="<?= $indice ?>">-->
                            <button type="submit" name="eliminar" value="<?php echo $indice; ?>">Eliminar  </button>
                            <!--<button type="submit" name="eliminar">Eliminar</button>-->
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <p><strong>Total de tareas mostradas:</strong> <?= count($tareasMostradas) ?></p>

</body>
</html>
