<?php
// La variable $uno se pasa por valor
// La variable $dos se pasa por referencia, lo que quiere decir
// que si se modifica dentro, su valor se mantiene fuera 
function ejemplo ($uno,&$dos)
{
	$uno++;
	$dos++;
	echo "<br>Dentro de ejemplo: Valor de uno es $uno";
	echo "<br>Dentro de ejemplo: Valor de dos es $dos";
}
$uno=1;
$dos=1;
echo "<br>Fuera antes de llamar: Valor de uno es $uno";
echo "<br>Fuera antes de llamar: Valor de dos es $dos";
ejemplo($uno,$dos);
echo "<br>Fuera, después de llamar: Valor de uno es $uno";
echo "<br>Fuera, después de llamar: Valor de dos es $dos<br>";

// Ámbito de una variable. La variable $a es de ámbito local. Solo es conocida dentro de la //función.
$a = 1;
test();

function test()
{	
	echo $a;
}

//Segundo ejemplo. Variales globales
$b=1;
$c=2;
suma();
echo 'El valor de la variable $c es: ', $c;
function suma()
{
	global $b,$c;
	$c = $b + $c;
}

//Uso de variables static. Sólo es visible dentro de la función donde se declaró
echo "<br>Función contador_static:";
/* Cuando una función necesite recordar información de su ejecución anterior */

function contador_static()
{
	static $inc=0; //Mantener el valor de la variable entre //distintas llamadas a la función
	$inc++;
	echo "<br>El valor de la variable \$inc es:",$inc;

}
contador_static();
contador_static(); //A pesar de inicializarse a 0, al ser definida //como static, se tiene en cuenta sólo la primera vez.

echo "<br>Función Contador:";
function contador()
{
	$inc2=0;
	$inc2++;
	echo "<br>El valor de la variable \$inc2 es: ", $inc2;
}
contador();
contador();

$inc1=0;
echo "<br>Función contador_global:";
/*Usaremos una variable global cuando múltiples partes independientes del código, accedan o modifiquen la misma información.*/
function contador_global()//$inc1 también es conocida fuera
{
	global $inc1;
	$inc1++;
	echo "<br>Dentro de función: El valor de la variable \$inc1 global es:",$inc1;
}
echo "<br>Fuera de función: El valor de la variable \$inc1 global es ", $inc1;

contador_global();
contador_global();

//Valores por defecto en los parámetros de una función

$precio = 10;
function precioConDescuento($precio, $descuento =10)
{
	return $precio * (100 - $descuento)/100;
}

$precioRebajado = precioConDescuento($precio);
echo "<br> El precio con descuento estándar es: ", $precioRebajado;
// Se asume que el segundo parámetro es 10
$precioRebajado = precioConDescuento($precio,25);
echo " <br>El precio con 25% descuento estándar es: ", $precioRebajado;

// A partir de la versión 7, se puede indicar el tipo de dato
// de cada parámetro así como el tipo de dato devuelto
function precioConDescuento1 (float $precio, int $descuento):float
{
	return $precio * (100 - $descuento) / 100;
}

?>