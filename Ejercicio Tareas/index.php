<?php
session_start();
require_once("funciones.php");
$error='';
//$_SESSION["tareas"] = ["Repasar PHP" =>1, "Hacer ejercicio de sesiones" => 2, "Estudiar arrays" => 3];

if(!isset($_SESSION['tareas'])){
    $_SESSION['tareas'] = ["Repasar PHP", "Hacer ejercicio de sesiones", "Estudiar arrays"];
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    //Limpiar Todo
    if(isset($_POST["borrar_todo"])){
        //limpiarSession();
        $_SESSION['tareas'] = [];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
    }

    //Agregar

    if(isset($_POST["agregar"])){
        //$nuevaTarea = limpiarTexto($_POST['tarea] ?? '');
        $nombreTarea = $_POST["tarea"];
        if(!empty($nombreTarea)){
        //$nombreTarea = htmlspecialchars(trim($_POST["tarea"]));
        $tareaLimpio = limpiarTarea($nombreTarea);
        $_SESSION['tareas'][]= $tareaLimpio;
        
            header("Location: " . $_SERVER['PHP_SELF']);
               exit;
        }else
        {
            $error = "No puede estar vacio";
        }

 
    }

    if (isset($_POST['eliminar'])){
        $indice = (int) ($_POST['eliminar']);
        if(isset($_SESSION['tareas'][$indice])){
            unset($_SESSION['tareas'][$indice]);

            $_SESSION['tareas'] = array_values($_SESSION['tareas']);
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
    

}
if (isset($_GET['buscar'])) {
    $textBusqueda = trim($_GET['textoBusqueda'] ?? '');
    if ($textBusqueda !== '') {
        $tareasMostrar = busqueda($textBusqueda);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Lista de Tareas Pendientes</h1>
<form action="index.php" method="POST">
<button type="submit" id="limpiarTarea" name="borrar_todo">Vaciar Lista</button>
</form>
<hr>
<h1>Nueva Tarea</h1>
<form action="index.php" method="POST">
<label for="nuevaTarea">Tarea:</label>
<input type="text" name="tarea">
<button  type="submit" name="agregar">Añadir</button>
</form>
<hr>
<h1>Tareas Actuales</h1>

<form action="index.php" method="GET">
<label for="tareasActuales">Buscar:</label>
<input type="search" name="textoBusqueda">
<button type="submit" name="buscar" id="filtrar">Filtrar</button>
</form>
<br/> <br/>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr> 
            <th>#</th>
            <th>Tarea</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($_SESSION["tareas"])):?>
           <?php $contador=1; ?> 
        <?php foreach( $_SESSION["tareas"] as $indice => $tarea):?>
            
        <tr>
            <td><?php echo $contador?></td>
            <td><?php echo $tarea ?></td>
            <form action="index.php" method="POST">
            <td><button type="submit" name="eliminar" value="<?php echo $indice?>">Eliminar</button></td>
            </form>
        </tr>
        <?php $contador++ ?>
        <?php endforeach?>
        <?php else:?>
            <tr>
            <td colspan="3">No hay tareas que mostrar</td>
            </tr>
            <?php endif?>
            
    </tbody>
</table>
<br>
    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
<?php echo "Total de tareas mostradas: " . count($_SESSION["tareas"]);?>
</body>
</html>