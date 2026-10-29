<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcion</title>
</head>
<body>
    <form action="" method="post">
        <label for="cadena">Cadena: </label><input type="text" name="cadena"></br>
        <button type="submit" name="enviando">Comprobar</button>
    </form>
    <br>
    <?php
        # haz una función que reciba una cadena y verifique si tiene minimo 8 caracteres, una mayuscula, una minuscula, un numero y un caracter especial
        if (isset($_POST["enviando"])) {
            $cadena = $_POST["cadena"];

            function validarPassword(string $pwd) : bool {
                $tieneLongitud = strlen($pwd) >= 8;
                $tieneMayuscula = preg_match('/[A-Z]/', $pwd);
                $tieneMinuscula = preg_match('/[a-z]/', $pwd);
                $tieneNumero = preg_match('/[0-9]/', $pwd);
                $tieneCaracter = preg_match('/[^A-Za-z0-9]/', $pwd);
                if ($tieneLongitud && $tieneMayuscula && $tieneMinuscula && $tieneNumero && $tieneCaracter) {
                    echo "<br>La cadena es válida.";
                    return true;
                } else {
                    echo "<br>La cadena no es válida.";
                    return false;
                }
            }
            
            echo validarPassword($cadena);
        }

        # Crea una funcion que censure un conjunto de palabras 

        function censurarPalabras(string $frase) {
            $palabrasCensuradas = ["carmen", "david", "annie"];
            $censura = "***";
            return str_replace($palabrasCensuradas, $censura, $frase);
        }

        echo "<h4>Actividad censurar palabras: </h4>";
        echo censurarPalabras("Las personas que no estén censuradas van a aprobar PHP: david, carmen, belen, annie ");

    ?>
</body>
</html>

