<?php
session_start();
if (!isset($_SESSION["alumnosCal"])) {
    $_SESSION["alumnosCal"] = [];
}
$error='';
try{
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["añadir"])){
        if(empty(trim($_POST["nameStudent"])) || empty(trim($_POST["lastname"]))){
        throw new Exception("Todos los campos deben estar completos");
    }
    $name= $_POST["nameStudent"];
    $lastname = $_POST["lastname"];
    $notaRand = random_int(0, 10);
    $_SESSION["alumnosCal"] []= [ "nombre" => $name, "apellidos" => $lastname, "nota" =>$notaRand ];
    header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }


        if (isset($_POST["ordenar"])) {
            if(empty($_SESSION["alumnosCal"])){
        throw new Exception("Debes añadir alumnos");
    }
            usort($_SESSION["alumnosCal"], function($a, $b) {
                return $b['nota'] <=> $a['nota'];
            });
                header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }

    if(isset($_POST["vaciar"])){
        session_destroy();
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    }
}

}catch(Throwable $exception){
    $error = $exception -> getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificaciones</title>
</head>
<body>
    <h1>Registro de Calificaciones</h1>
    <?php 
    echo "Alumnos registrados: ". count($_SESSION["alumnosCal"]);
    ?>

    <p><?php echo $error ?></p>
    <form action="" method="POST">
    <p>
    <label for="nombre">Nombre:</label>
    <input type="text" name="nameStudent">
    </p>
    <p>
    <label for="apellido">Apellidos:</label>
    <input type="text" name="lastname">
    </p>

    <p>
        <button type="submit" name="añadir">Añadir Alumno</button>
        <button type="submit" name="ordenar">Ordenar de Mayor a Menor</button>
        <button type="submit" name="vaciar">Vaciar Tabla</button>
    </p>
    </form>

        <table border="0" cellpadding="6" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Calificación</th>
        </tr>
        <?php if(!empty($_SESSION["alumnosCal"])):?>
        <tbody>
            <?php foreach ($_SESSION["alumnosCal"] as $indice => $alumno):?>
            <tr>
                
                <td><?php echo $indice+1?></td>
                <td><?php echo $alumno["nombre"]?></td>
                <td><?php echo $alumno["apellidos"]?></td>
                <td><?php echo $alumno["nota"]?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
        <?php else: ?>
             <tr>
                
                <td colspan="4">Introduce datos para añadir alumnos</td>
                </tr>
        <?php endif;?>
    </table>
</body>
</html>