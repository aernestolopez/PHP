<?php
session_start();
//require_once("funciones.php");
$error = '';
$mensajeOk = '';
function partidosIniciales(){
    return [
        [
            "local" => "FC Barcelona", "golesLocal" => 2, "golesVisitante" => 0, "visitante" => "Sevilla FC"
        ],
        [
            "local" => "Real Madrid", "golesLocal" => 1, "golesVisitante" => 2, "visitante" => "Real Betis Balompié"
        ],
        [
            "local" => "Valencia FC", "golesLocal" => 0, "golesVisitante" => 0, "visitante" => "Atlético de Madrid"
        ],
    ];
}

function validarDatos(array $equipos, array $partidos, string $local, string $visitante, string $golesLocal, string $golesVisitante){

if($local === '' || $visitante === '' || $golesLocal === '' || $golesVisitante === ''){
    throw new Exception("Debes rellenar todos los datos");
}    

if(array_search($local, $equipos)=== false || array_search($visitante, $equipos)=== false){
        throw new Exception("Los equipos deben ser los definidos");
    }

if($local === $visitante){
    throw new Exception("El local y el visitante no pueden ser los mismos");
}

if(!ctype_digit($golesLocal) || !ctype_digit($golesVisitante)){
    throw new Exception("Los goles deben ser numeros enteros y no pueden ser negativos");
}

/*if((int) $golesLocal < 0 || (int) $golesVisitante < 0){
    throw new Exception("Los goles no pueden ser negativos");
}*/

foreach ($partidos as $partido){
    if($partido["local"] === $local && $partido["visitante"] === $visitante){
        throw new Exception("No se puede jugar el mismo partido");
    }
}
}

function limpiarDatos(string $dato){
    $limpio = trim($dato);
    $limpio = htmlspecialchars($limpio);
    return $limpio;
}

function calcularClasificacion(array $partidos, array $equipos){
    $clasificacion = [];
    foreach ($equipos as $equipo){
        $clasificacion[$equipo] = [
            "nombre" => $equipo,
            "puntos" => 0,
            "gf" => 0
        ];
    }
    foreach($partidos as $partido){
    $clasificacion[$partido["local"]]["gf"] += $partido["golesLocal"];
    $clasificacion[$partido["visitante"]]["gf"] += $partido["golesVisitante"];

    if((int) $partido["golesLocal"] > (int)$partido["golesVisitante"]){
        $clasificacion[$partido["local"]]["puntos"] += 3;
    }elseif((int) $partido["golesLocal"] < (int)$partido["golesVisitante"]){
        $clasificacion[$partido["visitante"]]["puntos"] += 3;
    }else{
        $clasificacion[$partido["local"]]["puntos"] += 1;
        $clasificacion[$partido["visitante"]]["puntos"] += 1;
    }
    }

    print_r($clasificacion);

    usort($clasificacion, function($a, $b){
        if($a["puntos"] === $b["puntos"]){
            return $b["gf"] <=> $a["gf"];
        }
            return $b["puntos"] <=> $a["puntos"];
    });

    return $clasificacion;

}


$equipos = ["FC Barcelona", "Real Madrid", "Atlético de Madrid", "Real Betis Balompié",
            "Sevilla FC", "Valencia FC"
];

if(!isset($_SESSION["partidos"])){
    $_SESSION["partidos"] = partidosIniciales();
}

//["local" => "equipo", "golesLocal" => 0, "golesVisitante" => 0, "visitante" => "equipo"]

if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["vaciar"])){
        $_SESSION["partidos"] = [];
        $mensaje = "Datos vacios";
        header("Location:index.php?mensaje=". urlencode($mensaje));
        exit;
    }

    if(isset($_POST["original"])){
    session_destroy();
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_POST["anadir"])){
        $local = limpiarDatos($_POST["local"] ?? '');
        $visitante = limpiarDatos($_POST["visitante"] ?? '');
        $golesLocal = limpiarDatos($_POST["golesLocal"] ?? '');
        $golesVisitante = limpiarDatos($_POST["golesVisitante"] ?? '');

        try{
            validarDatos($equipos, $_SESSION["partidos"], $local, $visitante, $golesLocal, $golesVisitante);
            $mensaje="Datos añadidos";
            $_SESSION["partidos"] [] = ["local" => $local, "golesLocal" => (int)$golesLocal, "golesVisitante" => (int)$golesVisitante, "visitante" => $visitante];
            header("Location:index.php?mensaje=". urlencode($mensaje));
        }catch(Throwable $e){
            $error = $e -> getMessage();
        }
    }

}

$tabla = calcularClasificacion($_SESSION["partidos"], $equipos);
$mensajeOk = $_GET["mensaje"];
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
        <p style="color: red;"><?php echo $error?></p>
    <?php endif; ?>

    <?php if ($mensajeOk !== ''): ?>
        <p style="color: green;"><?php echo $mensajeOk?></p>
    <?php endif; ?>

    <form method="POST" action="index.php">
        <button type="submit" name="original">Mostrar clasificación original</button>
        <button type="submit" name="vaciar">Vaciar puntos</button>
    </form>

    <hr>

    <form method="POST" action="index.php">
        <select name="local">
            <?php foreach ($equipos as $equipo):?>
                <option value="<?php echo htmlspecialchars($equipo)?>"><?php echo htmlspecialchars($equipo)?></option>
            <?php endforeach;?>
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
            <?php foreach ($equipos as $equipo):?>
                <option value="<?php echo htmlspecialchars($equipo)?>"><?php echo htmlspecialchars($equipo)?></option>
            <?php endforeach;?>
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
        <?php foreach ($tabla as $indice => $dato):?>
            <tr>
                <td><?php echo $indice+1?></td>
                <td><?php echo $dato["nombre"]?></td>
                <td><?php echo $dato["puntos"]?></td>
                <td><?php echo $dato["gf"]?></td>
            </tr>
        <?php endforeach;?>
    </table>

    <?php if(empty($_SESSION["partidos"])): ?>
    <h2>Partidos jugados</h2>
        <p>No hay partidos jugados.</p>
    <?php else:?>
        <ul>
            <?php foreach ($_SESSION["partidos"] as $datos):?>
                <li><?php echo $datos["local"]?> <?php echo $datos["golesLocal"] ?> -<?php echo $datos["golesVisitante"]?>
                <?php echo $datos["visitante"] ?>
                </li>
            <?php endforeach;?>
        </ul>
    <?php endif; ?>
</body>

</html>