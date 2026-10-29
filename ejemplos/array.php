<?php
    $array[0] = 21;
    $array[1] = 'calabaza';
    $array[2] = 'patata';

    // forma de definir un array
    $finde = array('sábado', 'domingo');

    // una matriz (array bidimensional)
    $agenda1['sábado']['mañana'] = 'estudiar';
    $agenda1['sábado']['tarde'] = 'cocinar tarta';
    $agenda1['domingo']['mañana'] = 'cumpleaños';
    $agenda1['domingo']['tarde'] = 'dormir';

    // array asociativo (similar a un JSON)
    $persona = 
    [
        'nombre' => 'Marta',
        'genero' => 'Femenino',
        'edad' => 12
    ];

    // array unidimensional
    $agenda['lunes'] = 'hacer ejercicio';
    $agenda['martes'] = 'programar';
    $agenda['miercoles'] = 'dar clases de inglés';
    $agenda['jueves'] = 'hacer ejercicio';
    $agenda['viernes'] = 'dormir';
    
    // array multidimensional
    $grupo = [
        [
            'nombre' => 'Belén',
            'sexo' => 'Femenino',
            'edad' => 19
        ],
        [
            'nombre' => 'David',
            'sexo' => 'Masculino',
            'edad' => 19
        ]
    ];

    echo "Días no lectivos: ", $finde[0]. " y ". $finde[1];
    echo "<br>El total de dias lectivos es: ". count($agenda);
    echo "<br>Valor de la segunda posición del array: ".$array[1];
    echo "<br>Valor de la última posición del array: ".end($array);
    echo "<br>Valor de la primera posición del array: ".reset($array);
    echo "<br>".$persona['nombre']." tiene ".$persona['edad']." años.";
    echo "<br>Despues de ".$agenda['martes']." toca ".$agenda['miercoles'];
    echo "<br>El grupo lo forman ".count($grupo)." personas: ".$grupo[0]['nombre']." y ".$grupo[1]['nombre'];
    echo "<br>Las edades de ambos miembros suman: ".($grupo[0]['edad'] + $grupo[1]['edad']);
    echo "<br>El sábado por la tarde toca ".$agenda1['sábado']['tarde'];
    
    $elementos = array_keys($persona);
    echo "<br>";
    print_r($elementos);
    $mostrar = implode(", ", $elementos);
    echo "<br> Los elementos de \$persona son ". $mostrar;
    
    $elementos1 = array_keys($agenda);
    $mostrar1 = implode(", ", $elementos1);
    echo "<br> Los elementos de \$agenda son ". $mostrar1;

    $elementos2 = array_keys($grupo[1]);
    $mostrar2 = implode(", ", $elementos2);
    echo "<br> Los elementos de \$grupo son ". $mostrar2;

    $nombres = array_column($grupo, 'nombre');
    echo "<br> Los nombres del array \$grupo son ". implode(", ", $nombres);

    
    ?>