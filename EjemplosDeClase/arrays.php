<?php
// Definición y uso de arrays
        $array[] = 23;
        $array[1] = "segunda";
        $array[2] = "tercer";
        $finde = array('sábado', 'domingo');
        $lectivos[0] = 'lunes';
        $lectivos[1] = 'martes';
        $lectivos[2] = 'miércoles';
        $lectivos[3] = 'jueves';
        $lectivos[4] = 'viernes';

echo "<br> Días no lectivos: ", $finde[0]. " y ". $finde[1], "<br>";
echo "<br> El total de días lectivos es ", count($lectivos). "<br>";

echo "Valor de la segunda posición del array: ", $array[1];
echo "<br>El último elemento del array es: ", end($array), "<br>";
echo "El primer elemento del array es: ", reset($array), "<br>";

/* Array asociativo. Se utilizan claves con nombre en lugar de índices numéricos */
         
$persona =
        [
           'nombre' => 'Marta',
           'género' => 'Femenino',
           'edad' => 12
          ];

$agenda['lunes'] = 'correr';
$agenda['martes'] = 'compras';
$agenda['miércoles'] = 'gimnasio';
$agenda['jueves'] = 'fiesta';
$agenda['viernes'] = 'limpieza';

echo $persona['nombre']. " tiene " .$persona['edad']. " años <br>";
echo "Después de la ".$agenda['jueves'];
echo " toca ".$agenda['viernes']. "<br>";

// Array multidimensional 
$grupo = [
['nombre' => 'Marta', 'sexo' => 'Mujer', 'edad' => 12],
['nombre' => 'Eira', 'sexo' => 'Mujer', 'edad' => 8] 
];
//Buscar un determinado elemento en un array asociativo
$pos = array_search('Marta', $persona);
$agenda['sabado']['mañana'] = 'estudiar';
$agenda['sabado']['tarde'] = 'estudiar';
$agenda['domingo']['mañana'] = 'descansar';
$agenda['domingo']['tarde'] = 'cine';

echo "El grupo lo forman ", count($grupo), " personas: ";
echo $grupo[0]['nombre']. " y " .$grupo[1]['nombre']. "<br>";
echo "Las edades de ambos miembros suman ", $grupo[0]['edad'] + $grupo[1]['edad'], " años ";
echo "<br>El domingo por la tarde toca ". $agenda['domingo']['tarde'];

//Para array asociativo, si queremos mostrar los elementos que lo componen
$elementos = array_keys($persona);
/* Aquí no podemos mostrar $elementos con echo (sólo muestra texto básico) */
//echo "Elementos de $elementos ", $elementos;
echo "<br>";
print_r($elementos);
$mostrar = implode(',', $elementos);
echo "<br> Los elementos de \$persona son ", $mostrar;

$elementos1 = array_keys($agenda);
$mostrar1 = implode(' ,', $elementos1);
echo "<br> Los elementos de \$agenda son ", $mostrar1;

//Para un array multidimensional
$elementos2 = array_keys($grupo[1]);
$mostrar2 = implode(' ,', $elementos2);
echo "<br> Los elementos de \$grupo son ", $mostrar2;

//Mostrar valor de una determinada columna
$nombres =array_column($grupo, 'nombre');
echo "<br> Los nombres del array \$grupo son ", implode(', ',$nombres);
?>