<?php
function censuraTexto(string $texto, array $palabrasProhibidas,&$numero): string {
	$censura= '***';
	return str_replace($palabrasProhibidas, $censura, $texto,$numero);
}

$insultos = ['tonto', 'feo', 'malo'];

$comentario = "Este diseño es feo y el servicio es malo";
echo censuraTexto($comentario,$insultos,$numero);
echo " y el número de palabras censuradas es de ", $numero;
?>