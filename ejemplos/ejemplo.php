<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function ejemplo ($uno, &$dos) {
            $uno++;
            $dos++;

            echo "<br>Dentro de ejemplo: Valor de uno es $uno";
            echo "<br>Dentro de ejemplo: Valor de dos es $dos";
        }

        $uno=1;
        $dos=1;
        echo "<br>Fuera, antes de llamar: Valor de uno es $uno";
        echo "<br>Fuera, antes de llamar: Valor de dos es $dos";
        ejemplo($uno, $dos);
        echo "<br>Fuera, despues de llamar: Valor de uno es $uno";
        echo "<br>Fuera, despues de llamar: Valor de dos es $dos";

        //Ámbito de una variable
        $a = 1;
        test();

        function test() {
            global $a;
            echo "<br><br>$a<br>";
        }

        // Segundo ejemplo. Variables globales
        $b=1;
        $c=2;
        suma();
        echo "El valor de la variable c es $c. <br><br>";

        function suma() {
            global $b,$c;
            $c = $b + $c;
        }

        // Uso de funciones gettype y settype
        // además de carácteres escapados

        "<br>";
        $x = 5;
        echo "a) \$x: valor: $x -- tipo: ", gettype($x). "<br>";
        $y = 10.5;
        echo "b) \$y: valor: $y -- tipo: ", gettype($y). "<br>";
        $z = (integer) $y;
        echo "c) \$y: valor: $y -- tipo: ", gettype($y). "<br>";
        echo "d) \$z: valor: $z -- tipo: ", gettype($z). "<br>";
        // Comprobar si la variable es de un tipo especifico
        if (is_integer($z)) {
            echo "Conversión realizada correctamente. <br>";
        }

        settype($z, "double");
        echo "e) \$z: valor: $z -- tipo: ", gettype($z). "<br>";
        echo "Más información sobre \$z";
        // Funcion que muestra valor y tipo de una variable
        var_dump($z);
        include("p1.php");

    ?>
</body>
</html>