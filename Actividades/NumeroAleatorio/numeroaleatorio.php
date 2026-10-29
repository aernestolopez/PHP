<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <p>Se ha generado un número aleatorio entre 1 y 50. Tienes 5 intentos para adivinarlo. Introduce el número: </p>
        <input type="number" name="numero" id="numero" min="1" max="50"><button type="submit" name="adivinarNumero  ">Comprobar número</button>
    </form>
    
    <?php

        if(isset($_POST['adivinarNumero'])) {
           
            $numeroUsuario = $_POST['numero'];
            $intentos = 5;

            while ($intentos > 0) {
                if ($numeroGenerar === $numeroUsuario) {
                    echo "<script>alert('¡Has acertado!');</script>";
                    $intentos = 0;
                } else {
                    $intentos--;
                    echo "<script>alert('El número es incorrecto. Intente de nuevo')</script>";
            
                }
            }
        }
    
    ?>
</body>
</html>