<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body style="align-items:center;">
    <h1 style="text-align:center;">Formulario</h1>
    <center>
         <form action="" method="post" style="padding:30px; background-color:whitesmoke; width:20%; border: 2px solid black;">
            <label for="nombre">Nombre: </label><input type="text" name="nombre"></br>
            
            <label for="edad">Edad: </label><input type="number" name="edad"></br>
            <button type="submit" name="enviando">Enviar</button>
        </form>
    </center>
</br>
    <center>
         <form action="" method="post" style="padding:30px; background-color:whitesmoke; width:20%; border: 2px solid black;">
            <label for="usuario">Usuario: </label><input type="text" name="usuario"></br>
            
            <label for="contraseña">Contraseña: </label><input type="password" name="contraseña"></br>
            <button type="submit" name="login">Enviar</button>
        </form>
    </center>

    <?php 
        if (isset($_POST["enviando"])) {
            $nombre = $_POST["nombre"];
            $edad = $_POST["edad"];
            echo "<h1>Datos introducidos</h1>";
            echo "<p><strong>Nombre: </strong> $nombre </p></br>";
            echo "<p><strong>Edad: </strong> $edad </p></br>";
        }
        
        if (isset($_POST["login"])) {
            $usuario = $_POST["usuario"];
            $contraseña = $_POST["contraseña"];

            if ($usuario == "Annie" && $contraseña = "1234") {
                echo "<center><h1 style='padding:30px; background-color:lightgreen; width:20%; border: 2px solid green; color:green;'>Usuario y contraseña correctos.</h1></center> ";
            } else {
                echo "<center><h1 style='padding:30px; background-color:pink; width:20%; border: 2px solid red; color:red;'>Usuario y contraseña incorrectos.</h1></center> ";
            }
        }
        
        ?>
       
</body>
</html>