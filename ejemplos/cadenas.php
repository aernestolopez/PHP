<?php
    $texto ="donde dije digo digo diego";

    echo str_replace("diego","recortes", $texto);
    echo "<br />";
    echo $texto, "<br>";

    $texto = "el dijo: es tarde ahora, pero es mejor si hay tres <br>";
    echo str_replace("es","**", $texto, $reemplazos);
    echo '<br/>Se han realizado: '.$reemplazos. ' reemplazos<br />';
    echo $texto;

    $arr = array("blue","red","green","red");

    print_r(str_replace("red","pink", $arr,$i));
    echo "Replacements: $i <br>";



    $find = array("Hello","world");
    $replace = array("B");
    $arr = array("hello","world","!");
    print_r(str_replace($find, $replace, $arr, $i));
    echo "<br>Replacements: $i <br>";

    $cadena = "<br>EstO eS UnA cadeNA de CARActeres <br>";
    echo strtolower($cadena);
    echo "<br />";
    echo strtoupper($cadena);


    $cadena1 = 'Pedro Juan Luis Marco Luis Pedro Juan Luis Pedro';

    echo"<br>";
    $saludo = "*** hoy es viernes ***";
    echo trim($saludo), "<br>";
    echo trim($saludo, "*");

    $texto = "Hola ,mundo en 123";
    if (preg_match("/mundo/", $texto)){
        echo "<br>¡Coincidencia encontrada!";
    } else {
        echo "<br>No hay coincidencia. <br>";
    }

    $frutas = ['Manzana', 'plátano', 'Naranja'];

    $texto = implode(",", $frutas);
    echo $texto;

    $post = "Aprendiendo #php y #regex para mejorar mi #codigo";
    $patron = "/#\w+/";

    if (preg_match($patron, $post, $match)) {
        echo "<br>El primer hashtag encontrado es: ". $match[0];
    }

    preg_match_all($patron,$post,$match);
    echo "<br>Todos los hashtags encontrados son: ".implode(", ", $match[0]);   
  
    //Cadena original
    $cadena = "El abecedario completo es algo largo y detallarlo exhaustivamente es costoso";

    $cadenaMinusculas = strtolower($cadena);
    $totalVocales = 0;
    $vocales = ['a', 'e', 'i', 'o', 'u'];
    echo "<h3>Cadena de texto: ".$cadena."</h3>";
    echo "<h3>Recuento de vocales: </h3>";
    echo "<ul>";

    foreach ($vocales as $vocal) {
        $numVeces = substr_count($cadenaMinusculas, $vocal);
        $totalVocales += $numVeces;

        echo "<li>La vocal $vocal aparece $numVeces veces</li>";
    }
    echo "</ul>";
    echo "<h3>Total de vocales: $totalVocales </h3>";

    
?>