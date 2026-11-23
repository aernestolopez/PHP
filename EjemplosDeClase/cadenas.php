<?php
//str_replace(find, replace,string, count).
/*Si la cadena en la que se realiza la búsqueda es un array, la operación de búsqueda y reemplazo se ejecuta con cada elemento del array */
$texto = "Donde dije digo digo Diego.";
echo str_replace("Diego", "recortes", $texto);
echo "<br />";
echo $texto, "<br>";

$texto = "El dijo: es tarde ahora, pero es mejor si hay tres <br>";
echo str_replace("es", "**", $texto, $reemplazos);
echo '<br/>Se han realizado: '.$reemplazos. ' reemplazos<br/>';
echo $texto;

$arr = array("blue","red","green","red");
/*A continuación para mostrar por pantalla el contenido del array usamos print_r. Con echo no se puede */
print_r(str_replace("red","pink",$arr,$i));
echo "Replacements: $i <br>";

//Podemos usar también un array tanto en la búsqueda como en el //reemplazo 
/* El primer elemento de $find es reemplazado por el primer elemento de $replace y así sucesivamente. Si no coinciden lo sustituye por espacio en blanco */
$find = array("Hello","world");
$replace = array("B");
$arr = array("Hello","world","!");
print_r(str_replace($find,$replace,$arr,$i));
echo "Replacements: $i <br>";


$cadena = "<br>EstO eS UnA cadeNA de CARActeres <br>";
echo strtolower($cadena);
echo "<br />";
echo strtoupper($cadena);

//Número de veces que aparece la subcadena $cadena2 en $cadena1
$cadena1 = 'Pedro Juan Luis Marco Luis Pedro Juan Luis Pedro';
$cadena2 = 'Luis';
echo '<br>Luis aparece '.substr_count($cadena1, $cadena2). ' veces';

//Se eliminan los caracteres especificados en el argumento 2.
// Si no se especifica nada, elimina espacios en blanco, saltos de //línea y tabuladores
echo "<br>";
 $saludo = "*** hoy es viernes ***";
echo trim($saludo), "<br>";
echo trim($saludo, "*");


//Buscar una coincidencia en una cadena de texto. El patrón debe 
// incluir delimitadores
$texto = "Hola mundo en 123";
if (preg_match("/mundo/", $texto)) {
    echo "<br>¡Coincidencia encontrada!";
} else {
    echo "No hay coincidencia. <br>";
}

$frutas = ['Manzana', 'Plátano', 'Naranja'];
// Unimos el array usando ", " como separador
$texto = implode(", ", $frutas);
echo $texto; 
// Salida: Manzana, Plátano, Naranja



$post = "Aprendiendo #php y #regex para mejorar mi #codigo.";
$patron = "/#\w+/"; 
// Busca el símbolo # seguido de letras o números
if (preg_match($patron, $post, $match)) {
    echo "El primer hashtag encontrado es: " . $match[0];
}
// Salida: El primer hashtag encontrado es: #php


preg_match_all($patron, $post, $matches);
echo "Todos los hashtags usados son: " . implode(", ", $matches[0]);
// Salida: Todos los hashtags usados son: #php, #regex, #codigo



// Determinar cuántas veces aparece cada vocal
//Cadena original
$cadena = "El abecedario completo es algo largo y detallarlo exhaustivamente es costoso";

// Convertimos toda la cadena a minúsculas para no perder la "E" inicial
$cadenaMinusculas = strtolower($cadena);

// Definimos las vocales que queremos buscar
$vocales = ['a', 'e', 'i', 'o', 'u'];

echo "<h3>Recuento de vocales:</h3>";
echo "<ul>";

$totalVocales = 0;

//$vocales: Array a recorrer
/*$vocal: Variable temporal que toma en cada iteración el valor de cada elemento del array */
foreach ($vocales as $vocal) {
    // substr_count cuenta cuántas veces aparece una subcadena dentro de otra
    $numVeces = substr_count($cadenaMinusculas, $vocal);
    $totalVocales += $numVeces;
    
    echo "La vocal $vocal aparece ". $numVeces, " veces <br>";
}

echo "</ul>";
echo "<p>En total hay $totalVocales vocales en la frase.</p>";


//Si queremos hacerlo con el bucle for sería así

/* $totalElementos = count($vocales);

for ($i = 0; $i < $totalElementos; $i++) {
    // Obtenemos la vocal actual usando el índice numérico
    $vocal = $vocales[$i];
    
    
    $numVeces = substr_count($cadenaMinusculas, $vocal);
    $totalVocales += $numVeces;
    
    echo "<li>La vocal <strong>" . strtoupper($vocal) . "</strong> aparece: <strong>$numVeces</strong> veces.</li>";
}

echo "</ul>";
echo "<p>En total hay $totalVocales vocales en la frase.</p>" */
?>

