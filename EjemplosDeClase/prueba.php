<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Página con PHP</title>
</head>
<body>
    <h1>Bienvenido a mi sitio web</h1>
    
    <!-- Aquí se ejecuta el código PHP dentro del HTML -->
    <p>Hoy es: 
    	<?php echo date("d-m-Y");
    	//Declaración de variables
    	//Por convenio el nombre de las constantes ha de ir en mayúsculas
    	define("PI", 3.14);
    	$entero = 3;
    	$entero1 = 4;
    	$real = 3.123;
    	$verdadero = true;
    	$falso = false;
    	$cadena = "Esto es una cadena";
        
        if($entero == $entero1)
        	echo "Son iguales";
        else
        	echo "Son distintos";
    	

        echo "El valor de la constante es ", PI;
    	echo "<br>", $cadena;
    	echo "<br> El valor de la variable real es ", $real;
        echo " <br>El valor de la variable entero es " , $entero;
        echo " <br>El valor de la variable verdadero es " , $verdadero;
        /* La función echo imprime una cadena vacia cuando el valor es falso . Usar var_dump($falso)*/
        echo " <br>El valor de la variable falso es <br>" , $falso;
        $modulo = "DAW2";
        print "<p> Módulo: {$modulo} </p>";
        

        // Uso de funciones gettype y settype
        // además de caracteres escapados
        "<br>";
        $x = 5;
        echo "a) \$x: valor: $x -- tipo:", gettype($x). "<br>";
        $y = 10.5;
        echo "b) \$y: valor: $y -- tipo:", gettype($y). "<br>";
 		$z = (integer) $y;
 		echo "c) \$y: valor: $y -- tipo:", gettype($y). "<br>";
 		echo "d) \$z: valor: $z -- tipo:", gettype($z). "<br>";
 		// Comprobar si una variable es de un determinado tipo
 		if (is_integer($z))
 			echo "Conversión realizada correctamente <br>";

 		settype($z, "double");
		echo "e) \$z: valor: $z -- tipo:", gettype($z). "<br>";
		echo "Más información sobre \$z";
		//Función que muestra tanto valor como tipo de una variable
		var_dump($z);		 				
		include ("funciones.php");
		/* Tenemos la opción require("funciones.php") con la diferencia de que si el archivo que se intenta incluir no lo encuentra, la ejecución del programa se detiene en ese punto */


    	?>


</p>
</body>
</html>
