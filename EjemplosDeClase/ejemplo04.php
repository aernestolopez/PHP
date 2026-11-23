<?php
if(isset($_GET['button'])) // Si se ha pulsado el botón
 {
 	if (isset($_GET['idioma'])) // Si se ha seleccionado alguno
 	{
$idioma=$_GET['idioma'];
if($idioma=="es")
$Bienvenida = "Tu nombre completo es ";
elseif ($idioma=="en")
$Bienvenida = "Your full name is ";
echo "$Bienvenida". $_GET['nombre']. $_GET['apellidos'];
}
 	if (isset($_GET['interes']))
 	  	{
 	  		echo "Tus intereses son: ";
 	  		foreach ($_GET['interes'] as $valor) 
 	  		{
 	  			echo $valor , "<br>";
 	  		}
 		}
 		if (isset($_GET['interes1']))
 	  	{
 	  		echo "Tus intereses son: ";
 	  		foreach ($_GET['interes1'] as $valor) 
 	  		{
 	  			echo $valor , "<br>";
 	  		}
 		}
}
?>