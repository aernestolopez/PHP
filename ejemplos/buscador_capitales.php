<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador Capitales</title>
</head>
<body>
    <h1>Buscador de Capitales</h1>
    <form action="" method="post">
        <p>Escribe un país</p>
        <input type="text" name="pais" id="pais">
        <button type="submit" name="enviando"> Buscar </button>
    </form>
    
    
    <?php
        
        $capitales = [
            "España" => "Madrid",
            "Francia" => "París",
            "Italia" => "Roma",
            "Argentina" => "Buenos Aires",
            "Mexico" => "Ciudad de  México"
        ];

        if (isset($_POST["enviando"])) {
            $pais = $_POST["pais"];
            $paisFormat = trim($pais);

            if (isset($capitales[$paisFormat])) {
                echo "La capital de ".$paisFormat . " es: ". $capitales[$pais];    
            } else {
                echo "Lo siento, no tengo ese país en mi base de datos";
            }
        }
    ?>
</body>
</html>