<?php
if (isset($_POST["envio"])) {
    $cantidad = $_POST["cantidad"];
    $valor = $_POST["valorInicial"];
    $conversion = $_POST["valorConversion"];

    $valorYardaMetros = 0.914;
    $valorPieMetros = 0.3048;
    $valorPulgadaMetros = 0.025;
    $valorMillaMetros = 1609.34;

    $metros = 0;

    if($valor = "pulgadas") {
        $metros = $cantidad * 0.025;
    } elseif ($valor = "pies") {
        $metros = $cantidad * 0.3048;
    } elseif ($valor = "yardas") {
        $metros = $cantidad * 0.914;
    } elseif ($valor = "millas") {
        $metros = $cantidad * 1609.34;
    }

    $total = 0;

    if ($conversion = "kilometros") {
        $total = $metros / 1000;
    } else if ($conversion = "centimetros") {
        $total = $metros * 100; 
    }

    

    echo $cantidad . " " .$valor. " a " . $conversion . " es: ". $total;;
    
}
?>