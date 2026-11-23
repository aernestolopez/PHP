<?php
$origen=$_POST['origen'];
$destino=$_POST['destino'];
$cantidad=$_POST['cantidad'];
$conversiones=array();
$conversiones["Pulgadas"]=["Centímetros"=>2.54,"Metros"=>0.0254,"Kilómetros"=>0.0000254];
$conversiones["Pies"]=["Centímetros"=>30.48,"Metros"=>0.3048,"Kilómetros"=>0.0003048];
$conversiones["Yardas"]=["Centímetros"=>91.44,"Metros"=>0.9144,"Kilómetros"=>0.0009144];
$conversiones["Millas"]=["Centímetros"=>160900,"Metros"=>1609,"Kilómetros"=>1.609];
echo $cantidad." ".$origen." son ";
echo $cantidad * $conversiones[$origen][$destino];
echo " ".$destino;
?>
