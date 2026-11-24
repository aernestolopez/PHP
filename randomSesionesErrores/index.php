<?php
session_start();

$_SESSION["alumnosCal"] = [];


if($_SERVER["REQUEST_METHOD"] === "POST"){
try{
    if(empty(trim($_POST["nameStudent"])) || empty(trim($_POST["lastname"]))){
        throw new Exception("Todos los campos deben estar completos");
    }
    $name= $_POST["nameStudent"];
    $lastname = $_POST["nameStudent"];

    if(isset($_POST["añadir"])){
    $_S

    }


if(isset($_POST["ordenar"])){

}

    if(isset($_POST["vaciar"])){
        session_destroy();
        header("Location:" . $_SERVER['PHP_SELF']);
        exit;
    }

}catch(Throwable $exception){
    echo $exception -> getMessage();
}

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

    <table>
        <table border="0" cellpadding="6" cellspacing="0">
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Calificación</th>
        </tr>
    </table>
    </table>
</body>
</html>