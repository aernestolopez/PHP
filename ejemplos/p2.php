<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // Operaciones con variables

    $num1 = 4;
    $num2 = 5;
    $num3 = 6;
    
    echo "Número 1: ". $num1;
    echo "<br>Número 2: ". $num2;
    echo "<br>Número 3: ". $num3;
    echo "<br>La suma de los dos numeros es: ". $num1 + $num2;
    echo "<br>La resta de los dos numeros es: ". $num1 - $num2;
    echo "<br>La multiplicación de los dos números es: ". $num1 * $num2;
    echo "<br>La división de los dos números es: ". ($num1 / $num2) . "<br>";

    if ($num1 > $num2 && $num1 > $num3) {
        echo "El número ". $num1." es el mayor número entre los tres.";
    } else if ($num2 > $num1 && $num2 > $num3) {
        echo "El número ". $num2." es el mayor número entre los tres.";
    } else {
        echo "El número ". $num3." es el mayor número entre los tres.";
    }

    ?>
        
</body>
</html>