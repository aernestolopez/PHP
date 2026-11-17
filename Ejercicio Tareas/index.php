<?php
session_start();
$_SESSION["tareas"] = ["tarea 1" =>1, "tarea 2" => 2, "tarea 3" => 3];
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
<button type="button" id="limpiarTarea">Vaciar Lista</button>
<hr>
<h1>Nueva Tarea</h1>
<label for="nuevaTarea">Tarea:</label>
<input type="text" name="introducirTarea">
<button  type="button" id="nuevaTarea">Añadir</button>
<hr>
<h1>Tareas Actuales</h1>
<label for="tareasActuales">Buscar:</label>
<input type="search" name="buscadorTareas" id="buscarTareas">
<button type="button" id="filtrar">Filtrar</button>
<br/> <br/>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <?php if(!empty($_SESSION["tareas"])):?>
                
            <th>#</th>
            <th>Tarea</th>
            <th>Acción</th>
            
            <?php endif?>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $_SESSION["tareas"] as $tarea => $id):?>
        <tr>
            <td><?php echo $id?></td>
            <td><?php echo $tarea ?></td>
            <td><button type="button" id="eliminarUno">Eliminar</button></td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>
<br>
<?php if(!empty($_SESSION["tareas"])):?>
<?php echo "Total de tareas mostradas: " . count($_SESSION["tareas"]);?>
    <?php endif?>
</body>
</html>