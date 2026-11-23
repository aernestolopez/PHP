<?php
session_start();

// =========================================================================
// 1. FUNCIONES NORMALES Y TRABAJO CON CADENAS
// =========================================================================

function formatearNombre(string $nombre): string {
    $limpio = trim($nombre);
    //Transformar a minúsculas todas las letras incluidas Ñ, vocales con diéresis y vocales con acentos
    $minusculas = mb_strtolower($limpio);
    $capitalizado = ucwords($minusculas);
    return htmlspecialchars($capitalizado);
}




// Opción A: Pasando el array $jugadores por referencia
/*function ordenarPorPuntos(array &$jugadores, string $direccion): void {
    if ($direccion === 'asc') {
        usort($jugadores, function ($a, $b) {
            return $a['puntos'] - $b['puntos']; // Menor a mayor
        });
    } else {
        usort($jugadores, function ($a, $b) {
            return $b['puntos'] - $a['puntos']; // Mayor a menor
        });
    }
} */

//Sin usar paso de parámetros por referencia
function ordenarPorPuntos(array $jugadores, string $direccion): array {
    if ($direccion === 'asc') {
        usort($jugadores, function ($a, $b) 
        {
            return $a['puntos'] - $b['puntos'];
        });
    } else {
        usort($jugadores, function ($a, $b) {
            return $b['puntos'] - $a['puntos'];
        });
    }

// Si $a - $b < 0 -> $a está ordenado antes que $b
// Si $a - $b > 0 -> $b está ordenado antes que $a
    return $jugadores;
}

//Opción B: Usando el operador <=> y dos funciones independientes que se le pasan como parámetros a usort

// Función de comparación para ordenar de menor a mayor
function compararAsc(array $a, array $b): int {
    return $a['puntos'] <=> $b['puntos'];
}

// Función de comparación para ordenar de mayor a menor
function compararDesc(array $a, array $b): int {
    return $b['puntos'] <=> $a['puntos'];
}

function ordenarPorPuntos1(array $jugadores, string $direccion): array {
    if ($direccion === 'asc') {
        usort($jugadores, 'compararAsc');
    } else {
        usort($jugadores, 'compararDesc');
    }
    return $jugadores;
}


// =========================================================================
// 2. GESTIÓN DE SESIONES Y ACCIONES GET
// =========================================================================

if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

//Este if sirve para la primera vez que entras en la web o al pulsar el botón resetear
if (!isset($_SESSION['plantilla'])) {
    $_SESSION['plantilla'] = [
        ['dorsal' => 1,  'nombre' => 'Unai Simón','posicion' => 'Portero',        'puntos' => 72],
        ['dorsal' => 8,  'nombre' => 'Pedri','posicion' => 'Centrocampista', 'puntos' => 94],
        ['dorsal' => 19, 'nombre' => 'Lamine Yamal', 'posicion' => 'Delantero',      'puntos' => 110]
    ];
}
   // Mostrar la primera fila. No lo puedo hacer con echo directamente
   print_r($_SESSION['plantilla'][0]);
   // Mostrar el dorsal de la primera fila
   echo " <br>" , "Dorsal de la primera fila" , $_SESSION["plantilla"][0]['dorsal'], "<br>";
   //Mostrar todo el contenido del array de la Sesión
    print_r($_SESSION['plantilla']);



// =========================================================================
// 3. PROCESAMIENTO DEL FORMULARIO (POST)
// =========================================================================

$errores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dorsal   = (int) ($_POST['dorsal'] ?? 0);
    $nombre   = formatearNombre($_POST['nombre'] ?? '');
    $posicion = $_POST['posicion'] ?? 'Delantero';
    $puntos   = (int) ($_POST['puntos'] ?? 0);

    if ($nombre === '') {
        $errores[] = "El nombre del jugador no puede estar vacío.";
    }
    if ($dorsal < 1 || $dorsal > 99) {
        $errores[] = "El dorsal debe estar entre 1 y 99.";
    }

    foreach ($_SESSION['plantilla'] as $jugador) {
        // 1ª iteración: $jugador contiene $_SESSION['plantilla'][0] 
        if ($jugador['dorsal'] === $dorsal) {
            $errores[] = "El dorsal #{$dorsal} ya está asignado a {$jugador['nombre']}.";
            break;
        }
    }
// Si no hay errores, añade una nueva fila al array plantilla, cada vez que se envía el formulario

    if (empty($errores)) {
        $_SESSION['plantilla'][] = [
            'dorsal'   => $dorsal,
            'nombre'   => $nombre,
            'posicion' => $posicion,
            'puntos'   => $puntos
        ];
    }
}

// =========================================================================
// 4. PREPARACIÓN DE DATOS PARA LA VISTA (ORDENACIÓN GET)
// =========================================================================

//Esta instrucción es a la que salta cuando pulsamos 'Orden inicial' y después hace el foreach

$plantillaMostrar = $_SESSION['plantilla'];

//Si se ha pulsado el botón con name 'orden'
if (isset($_GET['orden'])) {
    //envío a la función ordenar el value del botón 'orden'
    $plantillaMostrar = ordenarPorPuntos($plantillaMostrar, $_GET['orden']);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Liga Fantasy - Repaso PHP</title>
</head>
<body>

    <h1>Gestor de Plantilla Fantasy</h1>

    <?php if (!empty($errores)): ?>
        <div>
            <strong>Corrige los siguientes errores:</strong>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <label>
            Dorsal (1-99):
            <input type="number" name="dorsal" min="1" max="99" required>
        </label>

        <label>
            Nombre del jugador:
            <input type="text" name="nombre" placeholder="Ej: Dani Olmo" required>
        </label>

        <label>
            Posición:
            <select name="posicion">
                <option value="Portero">Portero</option>
                <option value="Defensa">Defensa</option>
                <option value="Centrocampista">Centrocampista</option>
                <option value="Delantero" selected>Delantero</option>
            </select>
        </label>

        <label>
            Puntos Fantasy:
            <input type="number" name="puntos" value="50" required>
        </label>

        <button type="submit">Fichar jugador</button>
    </form>

<!--    <p>
        <a href="index.php?orden=desc">Ordenar por + puntos</a> |
        <a href="index.php?orden=asc">Ordenar por - puntos</a> |
        <a href="index.php">Orden original</a> |
        <a href="index.php?reset=1">Resetear plantilla</a>
    </p> -->
<br>
    <form method="GET" action="index.php">
    <button type="submit" name="orden" value="desc">Ordenar por + puntos</button>
    <button type="submit" name="orden" value="asc">Ordenar por - puntos</button>
    <button type="submit">Orden original</button>
    <button type="submit" name="reset" value="1">Resetear plantilla</button>
</form>

<br>
    <table border="1">
        <thead>
            <tr>
                <th>Dorsal</th>
                <th>Nombre</th>
                <th>Posición</th>
                <th>Puntos</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($plantillaMostrar as $jugador): ?>
                <tr>
            <!-- En cada iteración $jugador almacena todos los datos de cada fila del array completo $plantillaMostrar
                $plantillaMostrar[0]['dorsal']-->
                    <td>#<?= $jugador['dorsal'] ?></td>
                    <td><strong><?= $jugador['nombre'] ?></strong></td>
                    <td><?= htmlspecialchars($jugador['posicion']) ?></td>
                    <td><?= $jugador['puntos'] ?> pts</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>


