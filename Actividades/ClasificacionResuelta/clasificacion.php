<?php
// Array con los equipos de LALIGA 2026/2027 ordenados según la clasificación actual
$equipos = [
    1 => "Fútbol Club Barcelona",
    2 => "Club Atlético de Madrid",
    3 => "Real Madrid",
    4 => "Real Betis Balompié",
    5 => "Real Sociedad de Fútbol",
    6 => "Sevilla Fútbol Club",
    7 => "Deportivo Alavés",
    8 => "Real Club Celta de Vigo",
    9 => "Real Club Deportivo de A Coruña",
    10 => "Club Atlético Osasuna",
    11 => "Athletic Club",
    12 => "Villarreal Club de Fútbol",
    13 => "Rayo Vallecano de Madrid",
    14 => "Getafe Club de Fútbol",
    15 => "RCD Espanyol de Barcelona",
    16 => "Real Racing Club de Santander",
    17 => "Levante Unión Deportiva",
    18 => "Elche Club de Fútbol",
    19 => "Valencia Club de Fútbol",
    20 => "Málaga Club de Fútbol"
];

// --- FORMULARIOS PARA EL USUARIO ---
echo "<div style='background: #f4f4f4; padding: 15px; margin-bottom: 20px; border-radius: 5px;'>";
echo "  <h4>Buscador de la Liga</h4>";

// Formulario 1: Buscar por posición
// Al usar method='get', el navegador creará la URL: ?posicion=NUMERO
echo "  <form method='GET' action='' style='margin-bottom: 10px;'>";
echo "    <label>Buscar por Posición (1-20): </label>";
echo "    <input type='number' name='posicion' min='1' max='20' required>";
echo "    <button type='submit'>Consultar posición</button>";
echo "  </form>";

// Formulario 2: Buscar por nombre
// Al usar method='get', el navegador creará la URL: ?nombre=TEXTO
echo "  <form method='GET' action=''>";
echo "    <label>Buscar por Nombre: </label>";
echo "    <input type='text' name='nombre' required>";
echo "    <button type='submit'>Buscar equipo</button>";
echo "  </form>";

// Enlace para limpiar la búsqueda y volver a ver la tabla completa.
if (isset($_GET['posicion']) || isset($_GET['nombre'])) {
    echo "<br><a href='?'>← Volver a ver la clasificación completa</a>";
}
echo "</div>";
echo "<hr>";


// Función auxiliar para normalizar texto (quitar tildes y pasar a minúsculas)
function normalizarTexto($texto) {
    $originales = ['Á', 'É', 'Í', 'Ó', 'Ú', 'á', 'é', 'í', 'ó', 'ú'];
    $reemplazos = ['A', 'E', 'I', 'O', 'U', 'a', 'e', 'i', 'o', 'u'];
    return strtolower(trim(str_replace($originales, $reemplazos, $texto)));
}


// --- LÓGICA DE CONTROL 

// 1. CONTROL DE LA VARIABLE GET 'posicion'
/* No se necesita comprobar si se ha pulsado el botón porque si no ha llegado ninguna información a la URL, indirectamente no se ha pulsado el botón. */

if (isset($_GET['posicion']) && $_GET['posicion'] !== '') {
    $pos = (int)$_GET['posicion'];

    if (array_key_exists($pos, $equipos)) {
        echo "<h3>Información de posición:</h3>";
        echo "<p>El equipo que ocupa la posición <strong>$pos</strong> es el <strong>" . $equipos[$pos] . "</strong>.</p>";
        
        if (array_key_exists($pos - 1, $equipos)) {
            echo "<p>Por encima está el: " . $equipos[$pos - 1] . " (Posición " . ($pos - 1) . ")</p>";
        } else {
            echo "<p>Por encima no hay ningún equipo (es el líder actual).</p>";
        }

        if (array_key_exists($pos + 1, $equipos)) {
            echo "<p>Por debajo está el: " . $equipos[$pos + 1] . " (Posición " . ($pos + 1) . ")</p>";
        } else {
            echo "<p>Por debajo no hay ningún equipo (está en el último puesto).</p>";
        }
    } else {
        echo "<p>Error: La posición introducida no es válida.</p>";
    }
} 
// 2. CONTROL DE LA VARIABLE GET 'nombre'
elseif (isset($_GET['nombre']) && $_GET['nombre'] !== '') {
    $nombreBuscar = normalizarTexto($_GET['nombre']);
    $encontrado = false;

    foreach ($equipos as $pos => $nombreEquipo) {
        if (str_contains(normalizarTexto($nombreEquipo), $nombreBuscar)) {
            echo "<p>El equipo <strong>$nombreEquipo</strong> ocupa la posición número <strong>$pos</strong> en la clasificación.</p>";
            $encontrado = true;
            break;
        }
    }

    if (!$encontrado) {
        echo "<p>No se ha encontrado ningún equipo que coincida con '" . htmlspecialchars($_GET['nombre']) . "'.</p>";
    }
} 
// 3. VISTA POR DEFECTO: MOSTRAR LA TABLA COMPLETA
else {
    echo "<h2>Clasificación Actual</h2>";
    echo "<table border='1' cellpadding='8' style='border-collapse: collapse; text-align: left;'>";
    echo "<thead><tr style='background-color: #f2f2f2;'><th>Posición</th><th>Equipo</th></tr></thead><tbody>";
          
    foreach ($equipos as $pos => $nombreEquipo) {
        echo "<tr><td><strong>$pos</strong></td><td>$nombreEquipo</td></tr>";
    }
    
    echo "</tbody></table>";
}
?>