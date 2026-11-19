<?php
session_start();

if(!isset($_SESSION['plantilla'])){
    $_SESSION['plantilla'] = [
        ['dorsal' => 1, 'nombre' => 'Unai Simón', 'posicion' => 'Portero', 'puntos' => 72],
        ['dorsal' => 8, 'nombre' => 'Pedri', 'posicion' => 'Centrocampista', 'puntos' => 94],
         ['dorsal' => 19, 'nombre' => 'Lamine Yamal', 'posicion' => 'Delantero', 'puntos' => 110]
        ];
}
$mensajeError='';
print_r($_SESSION['plantilla'][0]);

function formatearNombre(string $nombre):string{
$nombreLimpio = trim($nombre);
$nombreLimpio = ucwords(mb_strtolower($nombreLimpio));
$nombreLimpio = htmlspecialchars($nombreLimpio);
return $nombreLimpio;
}

function ordenarPorPuntos(array $jugadores, string $direccion): array{
    usort($jugadores, function($a, $b) use ($direccion){
        if($direccion == 'desc'){
            return $b['puntos'] <=> $a['puntos'];
        }
        return $a['puntos'] <=> $b['puntos'];
    });

    return $jugadores;
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    if(isset($_POST["fichar"])){
        $nombre = formatearNombre($_POST["nombreJugador"]);
        $dorsal =  (int)($_POST["numDorsal"]);
        $posicion = $_POST["tipoPosicion"];
        $puntos = $_POST["puntosFantasy"];
        $repetido = false;
            foreach ($_SESSION['plantilla'] as $jugador){
        if ($dorsal === $jugador["dorsal"]){
            $repetido =true;
            $_SESSION['error'] = "Error: El dorsal #$dorsal ya está asignado a " . $jugador["nombre"] . ".";

        }
        }if(!$repetido){
            $_SESSION['plantilla'] [] = ['dorsal' => $dorsal, "nombre" =>$nombre, "posicion" => $posicion, "puntos" => $puntos];
        }
            header("Location: " . $_SERVER['PHP_SELF'], );
               exit;
    }
}


$plantillaMostrar = $_SESSION['plantilla'];
$ordenSeleccionado = "original"; 


if (isset($_GET["ordenMasPuntos"])) {
    $ordenSeleccionado = $_GET["ordenMasPuntos"]; 
   $plantillaMostrar = ordenarPorPuntos($_SESSION['plantilla'], $ordenSeleccionado );
}

if (isset($_GET["ordenMenosPuntos"])) {
    $ordenSeleccionado = $_GET["ordenMenosPuntos"]; 
    $plantillaMostrar = ordenarPorPuntos($_SESSION['plantilla'], $ordenSeleccionado );
}

if (isset($_GET["reset"])) {
    session_destroy();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }


$mensajeError = '';

if (isset($_SESSION['error'])) {
    $mensajeError = $_SESSION['error'];
    unset($_SESSION['error']); 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liga Fantasy</title>
</head>
<body>
    <h1>Gestor de Plantilla Fantasy</h1>
    <form action="index.php" method="POST">
    <label for="dorsal">Dorsal (1-99)</label>
    <input type="number" min="1" max="99" name="numDorsal" required>
    <label for="nombre">Nombre del jugador:</label>
    <input type="text" name= "nombreJugador" placeholder="Ej: Dani Olmo" required>
    <label for="posicion">Posición:</label>
    <select name="tipoPosicion" required>
        <option value="delantero">Delantero</option>
        <option value="centrocampista">Centrocampista</option>
        <option value="defensa">Defensa</option>
        <option value="portero">Portero</option>
    </select>
    <label for="puntos">Puntos Fantasy:</label>
    <input type="number" name="puntosFantasy" required>
    <button type="submit" name="fichar">Fichar Jugador</button>
    </form>
    <br>
    <br>
    <form action="index.php" method="GET">
        <button type="submit" name="ordenMasPuntos" value="desc">Ordenar por + puntos</button>
        <button type="submit" name="ordenMenosPuntos" value="asc">Ordenar por - puntos</button>
        <button type="submit">Orden original</button>
        <button type="submit" name="reset" value="1">Resetear Plantilla</button>
    </form>

<br>
    <table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr> 
            <th>Dorsal</th>
            <th>Nombre</th>
            <th>Posición</th>
            <th>Puntos</th>
        </tr>
    </thead>
    <tbody>
         <?php foreach( $plantillaMostrar as $jugador):?>
        <tr>
            <td><?php echo "#". $jugador["dorsal"]?></td>
            <td><?php echo $jugador["nombre"]?></td>
            <td><?php echo $jugador["posicion"]?></td>
            <td><?php echo $jugador["puntos"]?></td>
        </tr>
        <?php endforeach?>
    </tbody>
    </table>

    <?php echo $mensajeError?>

    <p>Valor recibido: <strong><?php echo htmlspecialchars($ordenSeleccionado); ?></strong></p>

</body>
</html>