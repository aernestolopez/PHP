<?php

date_default_timezone_set('Europe/Madrid');

    echo date("d-m-Y G:i:s");
    echo "<br>Fecha actual: ". date("d-m-Y");

    $fechaMktime = mktime(10,15,35,10,5,2019);
    echo "<br>Fecha generada con mktime: ".date("l d-m-Y G:i:s", $fechaMktime);

    $hoy = date_create();
    $fin = date_create("12/31/2026");

    $diferencia = date_diff($hoy, $fin);

    echo "<br><br>Faltan ".$diferencia -> format("%a") . " días para fin de año.";
    echo "<br>Faltan ".$diferencia -> format("%m") . " meses para fin de año.";
?>