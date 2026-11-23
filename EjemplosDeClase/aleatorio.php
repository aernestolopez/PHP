<?php
$v1=rand(1,30);// Número que tengo que adivinar
echo "Numero a adivinar \$v1:", $v1;
$v2=rand(1,30);
echo "<br>Primer número generado \$v2:", $v2;
$intentos =1;
do
{
 if($v2 > $v1)
 {
 	echo "<br>El número a adivinar es menor";
 	$intentos++;
 	$v2=rand(1,$v2-1);
 	echo "<br>Nuevo número generado", $v2;
 }
 elseif($v2<$v1)
 {
 echo "<br>El número a adivinar es mayor";
 	$intentos++;
 	$v2=rand($v2+1,30);	
 	echo "<br>Nuevo número generado", $v2;
 }
 else
 {
 echo "<br>Has acertado";
 //break;
}
}while (($intentos<6) && ($v1 != $v2)); 
?>