<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina con PHP</title>
</head>
<body>
    <h1>Bienvenido al sitio web</h1>
    <p>Hoy es: 
        <?php echo date("d-m-Y");
        
        // Definir constantes: define(nombre de constante, valor)
        define("Pi", 3.14);

        // Definir variables: $nombre = valor;
        $var1 = "bizcocho";
        $boolean = true;
        $numero = 500;
        $string = "Esto es una cadena de ejemplo";
        $array[] = 12;
        $array[1] = "segunda";
        $array[2] = "tercera";
        echo "<br>Receta para hoy: $var1 <br>Necesitamos $numero gramos de harina.<br>";
    
        if ($boolean = true) 
            print("El bizcocho esta muy rico.");
        


        echo "<br>";

        echo "El valor del numero pi es: ". Pi;
        echo "<br>El valor de la variable boolean es: ". $boolean;
        echo "<br>El valor de la variable string es: ". $string;
        echo "<br>El valor de la segunda posicion del array es: ". $array[1];
        echo "<br>El valor de la ultima posicion del array es: ". end($array);
        ?>
    </p>
</body>
</html>